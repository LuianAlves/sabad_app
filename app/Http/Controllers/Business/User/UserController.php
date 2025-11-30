<?php

namespace App\Http\Controllers\Business\User;

use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Business\User\StoreUserRequest;
use App\Http\Requests\Business\User\UpdateUserRequest;

// Models
use App\Models\User;
use App\Models\Business\Tickets\Ticket;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Dependences
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles', 'permissions')->get();

        return view('app.business.user.user_index', compact('users'));
    }

    public function create()
    {
        $roles = Role::with(['permissions'])->where('guard_name', 'web')->get();

        $permissions = Permission::all();

        $knownActions = ['view', 'create', 'edit', 'delete', 'show'];

        $groupedPermissions = $permissions->groupBy(function ($permission) use ($knownActions) {
            $parts = explode(' ', $permission->name);
            $first = strtolower($parts[0]);

            if (in_array($first, $knownActions)) {
                return implode(' ', array_slice($parts, 1));
            }

            return $permission->name;
        });

        return view('app.business.user.user_create', [
            'roles' => $roles,
            'permissions' => $permissions,
            'groupedPermissions' => $groupedPermissions,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $isAdmin = (bool) $request->is_admin;

        $imagemBase64 = null;

        if ($request->hasFile('image')) {
            $userImage = $request->file('image');
            $imageData = file_get_contents($userImage->getRealPath());

            $image = imagecreatefromstring($imageData);

            if ($image !== false) {
                $w = 250;
                $h = 250;
                $resizedImage = imagescale($image, $w, $h);

                ob_start();
                imagejpeg($resizedImage);
                $rawImage = ob_get_clean();

                $imagemBase64 = base64_encode($rawImage);

                imagedestroy($resizedImage);
                imagedestroy($image);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => (bool) $request->is_active,
            'image' => $imagemBase64,
            'created_at' => Carbon::now()
        ]);

        if ($isAdmin) {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');

            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('name', $request->permissions)->get();
                $user->syncPermissions($permissions);
            }
        }

        return redirect()->route('user.index');
    }

    public function show($userId)
    {
        $authId = auth()->id();

        if ((int)$userId !== (int)$authId && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
        
        $user = User::findOrFail($userId);

        $tickets = Ticket::get();

        return view('app.business.user.user_show', compact('user', 'tickets'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('app.business.user.user_edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        //
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }


    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Retorna as mensagens entre o usuário autenticado e outro usuário.
     * Também marca as mensagens recebidas como lidas.
     */
    public function messages($userId)
    {
        $authId = auth()->id();

        // Marca como lidas todas as mensagens recebidas ainda não lidas
        Message::where('sender_id', $userId)
            ->where('receiver_id', $authId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Busca as mensagens entre os dois usuários
        $messages = Message::where(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $userId)
                ->where('receiver_id', $authId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    /**
     * Lista todos os contatos (exceto o logado) e marca se há mensagens não lidas.
     */
    public function contacts()
    {
        $authId = auth()->id();
        $user = User::find($authId); // Obtém o usuário autenticado
        $users = User::where('id', '!=', $authId)->get();

        // Verifica se há mensagens não lidas de cada usuário
        foreach ($users as $contact) {
            $contact->unread_count = Message::where('sender_id', $contact->id)
                ->where('receiver_id', $authId)
                ->where('is_read', false)
                ->count();

            $contact->has_unread_messages = $contact->unread_count > 0;
        }
        return view('app.business.contacts', compact('user', 'users')); // Passa o usuário autenticado
    }

    public function checkMessages() {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        foreach ($users as $contact) {
            $contact->unread_count = Message::where('sender_id', $contact->id)
                ->where('receiver_id', Auth::user()->id)
                ->where('is_read', false)
                ->count();

            $contact->has_unread_messages = $contact->unread_count > 0;
        }

    //    dd($users);

        return response()->json([
            'status' => 'success',
            'count' => $users
        ]);
    }

}
