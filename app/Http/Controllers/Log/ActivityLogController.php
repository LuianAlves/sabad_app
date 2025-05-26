<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\ActivityLog;
use App\Models\User;

// Dependences
use App\Exports\LogsExport;
use Maatwebsite\Excel\Facades\Excel;


class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::query()->with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('model_type')) {
            $query->where('model_type', $request->model_type);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $logs = $query->latest()->paginate(20);

        $models = ActivityLog::select('model_type')->distinct()->pluck('model_type');
        $users = User::select('id', 'name')->get();

        if ($request->has('export')) {
            return Excel::download(new LogsExport($query->get()), 'logs_auditoria.xlsx');
        }

        dd($logs);
        
        return view('logs.activity_log_index', compact('logs', 'users', 'models'));
    }
}
