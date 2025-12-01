<?php

namespace App\Http\Controllers\Business\Production;

use App\Http\Controllers\Controller;
use App\Models\Business\Production\ProductionOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProductionOrderController extends Controller
{
    /**
     * INDEX GENÉRICO
     * Decide qual tela carregar com base no nome da rota:
     * - manager.index   → tela do gerente
     * - stock.index     → tela do estoque
     * - operator.index  → tela do operador
     * - tv.index        → painel/TV
     */
    public function index(Request $request)
    {
        $routeName = $request->route()->getName(); // ex: "manager.index", "stock.index", ...

        switch ($routeName) {
            case 'manager.index':
                return $this->managerIndex();

            case 'stock.index':
                return $this->stockIndex();

            case 'operator.index':
                return $this->operatorIndex();

            case 'tv.index':
                return $this->tvIndex();

            default:
                abort(404);
        }
    }

    /**
     * VIEW 1 – GERENTE
     * Lista tudo e mostra cards de status.
     */
    public function managerIndex()
    {
        // Todas as OFs
        $orders = ProductionOrder::orderByDesc('order_date')->get();

        // Status usados na tela
        $statuses = ['not_started', 'separated', 'in_production', 'finished'];

        // Ícones e cores dos cards
        $icons = [
            'not_started' => [
                'bg' => 'secondary',
                'icon' => 'fa-circle',
            ],
            'separated' => [
                'bg' => 'info',
                'icon' => 'fa-box-open',
            ],
            'in_production' => [
                'bg' => 'warning',
                'icon' => 'fa-industry',
            ],
            'finished' => [
                'bg' => 'success',
                'icon' => 'fa-check-circle',
            ],
        ];

        // Monta dados por status
        $statusData = [];
        foreach ($statuses as $status) {
            $query = ProductionOrder::where('status', $status);

            $statusData[$status] = [
                'count' => $query->count(),
                'latest' => $query->latest('order_date')->first(),
            ];
        }

        return view('app.business.production.manager_index', [
            'orders' => $orders,
            'statusData' => $statusData,
            'icons' => $icons,
        ]);
    }

    /**
     * CREATE – formulário "Nova Ordem de Produção"
     * Rota: manager.create (GET /manager/create)
     */
    public function create()
    {
        return view('app.business.production.manager_create');
    }

    /**
     * STORE – GERENTE cria uma nova OF
     * Rota: manager.store (POST /manager)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_date' => ['required', 'date'],
            'order_number' => ['required', 'string', 'max:50'],
            'client_name' => ['required', 'string', 'max:255'],
            'expedition_date' => ['required', 'date'],
        ]);

        $data['status'] = 'not_started';
        $data['created_by_id'] = Auth::id();

        ProductionOrder::create($data);

        return redirect()
            ->route('manager.index')
            ->with('success', 'OF cadastrada com sucesso.');
    }

    public function update(Request $request, ProductionOrder $manager)
    {
        // Vamos usar uma ação específica pra troca de status
        if ($request->input('action') === 'cycle_status') {

            $flow = [
                'not_started' => 'separated',
                'separated' => 'in_production',
                'in_production' => 'finished',
                'finished' => 'not_started', // se quiser que pare em finished, pode repetir 'finished'
            ];

            $oldStatus = $manager->status;
            $newStatus = $flow[$oldStatus] ?? $oldStatus;

            // Se não tiver mudança, só volta
            if ($newStatus !== $oldStatus) {
                $manager->update(['status' => $newStatus]);
            }

            return redirect()
                ->route('manager.index')
                ->with('success', "Status da OF {$manager->order_number} alterado para {$newStatus}.");
        }

        // Se no futuro tiver outro tipo de update, trata aqui
        abort(400, 'Ação de atualização inválida.');
    }

    public function destroy($id)
    {
        $order = ProductionOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('manager.index');
    }

    /* =========================================================================
     *  VIEWS ESPECÍFICAS (ESTOQUE / OPERADOR / TV)
     * ========================================================================= */

    /**
     * VIEW 2 – ESTOQUE
     * Mostra apenas OFs não iniciadas (fila de separação).
     */
    public function stockIndex()
    {
        $orders = ProductionOrder::notStarted()
            ->orderBy('created_at', 'asc')
            ->get();

        return view('app.business.production.stock_index', compact('orders'));
    }

    /**
     * VIEW 3 – PRODUÇÃO (OPERADOR)
     * Mostra OFs separadas e em produção.
     */
    public function operatorIndex()
    {
        $orders = ProductionOrder::whereIn('status', ['separated', 'in_production'])
            ->orderByRaw("FIELD(status, 'separated', 'in_production')")
            ->orderBy('created_at', 'asc')
            ->get();

        // >>> GARANTE QUE ESTA VIEW É A CERTA <<<
        return view('app.business.production.operator_index', compact('orders'));
    }

    /**
     * VIEW 4 – PAINEL/TV
     * Mostra OFs separadas e em produção em duas listas.
     */
    public function tvIndex()
    {
        $waiting = ProductionOrder::where('status', 'not_started')
            ->orderBy('created_at', 'asc')
            ->limit(10)
            ->get();

        $separated = ProductionOrder::where('status', 'separated')
            ->orderBy('created_at', 'asc')
            ->limit(10)
            ->get();

        $inProduction = ProductionOrder::where('status', 'in_production')
            ->orderBy('created_at', 'asc')
            ->limit(10)
            ->get();

        return view('app.business.production.tv_index', compact(
            'waiting', 'separated', 'inProduction'
        ));
    }


    public function tvData()
    {
        $waiting = ProductionOrder::where('status', 'not_started')
            ->orderBy('created_at', 'asc')
            ->limit(10)
            ->get();

        $separated = ProductionOrder::where('status', 'separated')
            ->orderBy('created_at', 'asc')
            ->limit(10)
            ->get();

        $inProduction = ProductionOrder::where('status', 'in_production')
            ->orderBy('created_at', 'asc')
            ->limit(10)
            ->get();

        return response()->json([
            'waiting' => $waiting->map(function ($o) {
                return [
                    'order_number'    => $o->order_number,
                    'client_name'     => $o->client_name,
                    'expedition_date' => optional($o->expedition_date)->format('d/m/Y'),
                ];
            }),
            'separated' => $separated->map(function ($o) {
                return [
                    'order_number'    => $o->order_number,
                    'client_name'     => $o->client_name,
                    'expedition_date' => optional($o->expedition_date)->format('d/m/Y'),
                ];
            }),
            'in_production' => $inProduction->map(function ($o) {
                return [
                    'order_number'    => $o->order_number,
                    'client_name'     => $o->client_name,
                    'operator'        => $o->production_operator_name,
                    'started_at'      => optional($o->production_started_at)->format('H:i'),
                    'expedition_date' => optional($o->expedition_date)->format('d/m/Y'),
                ];
            }),
        ]);
    }



    /**
     * ESTOQUE marca material separado
     * Rota: stock.separate (POST /stock/{order}/separate)
     */
    public function markSeparated(Request $request, ProductionOrder $order)
    {
        if ($order->status !== 'not_started') {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => 'Essa OF não está na fila de separação.',
                ], 422);
            }

            return back()->with('error', 'Essa OF não está na fila de separação.');
        }

        $order->update([
            'status' => 'separated',
            'stock_user_id' => Auth::id(),
            'stock_separated_at' => now(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'order' => $order,
            ]);
        }

        return back()->with('success', 'Material separado para a OF ' . $order->order_number);
    }

// 2) OPERADOR inicia produção (define nome e muda status)
    public function startProduction(Request $request, $id)
    {
        $order = ProductionOrder::findOrFail($id);

        if (!in_array($order->status, ['separated', 'in_production'])) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => 'Essa OF não está disponível para início de produção.',
                ], 422);
            }

            return back()->with('error', 'Essa OF não está disponível para início de produção.');
        }

        $data = $request->validate([
            'operator_name' => ['required', 'string', 'max:255'],
        ]);

        $update = [
            'production_operator_name' => $data['operator_name'],
            'production_user_id' => Auth::id(),
        ];

        if ($order->status === 'separated') {
            $update['status'] = 'in_production';
            $update['production_started_at'] = now();
        }

        $order->update($update);
        $order->refresh();

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'order' => $order,
            ]);
        }

        return back()->with('success', 'Produção iniciada/atualizada para a OF ' . $order->order_number);
    }

// 3) OPERADOR finaliza produção
    public function finishProduction(Request $request, $id)
    {
        $order = ProductionOrder::findOrFail($id);

        if ($order->status !== 'in_production') {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => 'Apenas OFs em produção podem ser finalizadas.',
                ], 422);
            }

            return back()->with('error', 'Apenas OFs em produção podem ser finalizadas.');
        }

        $order->update([
            'status' => 'finished',
            'production_finished_at' => now(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'order' => $order,
            ]);
        }

        return back()->with('success', 'OF ' . $order->order_number . ' finalizada.');
    }

    // ... (tudo o que você já tem)

    /**
     * Retorna o timestamp da última alteração em qualquer OF.
     * Usado pelo JS pra saber se precisa recarregar a tela.
     */
    public function ping()
    {
        $last = ProductionOrder::max('updated_at');

        $timestamp = $last
            ? Carbon::parse($last)->timestamp
            : 0;

        return response()->json([
            'last' => $timestamp,
        ]);
    }
}
