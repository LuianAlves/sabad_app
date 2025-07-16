<?php

namespace App\Http\Controllers;

use App\Models\Business\Company\Company;
use App\Models\Business\Department\Department;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications for the logged-in user.
     */
    public function index()
    {
        $user = auth()->user();

        $newNotifications = $user->notifications()
            ->wherePivot('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        $oldNotifications = $user->notifications()
            ->wherePivot('is_read', true)
            ->orderBy('created_at', 'desc')
            ->take(3)   // só as 3 últimas antigas
            ->get();

        return view('app.business.notification.notifications_index', compact('newNotifications', 'oldNotifications'));
    }


    public function create()
    {
        return view('app.business.notification.notifications_create', [
            'companies' => Company::all(),
            'departments' => Department::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created notification and assign to users.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'companies' => 'nullable|array',
            'companies.*' => 'integer|exists:companies,id',
            'departments' => 'nullable|array',
            'departments.*' => 'integer|exists:departments,id',
            'users' => 'nullable|array',
            'users.*' => 'integer|exists:users,id',
        ]);

        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'created_by' => auth()->id(),
        ]);

        $users = User::query();

        if ($request->filled('companies') && !in_array('all', $request->companies)) {
            $users->whereHas('employeeUser.employee.department', function($query) use ($request) {
                $query->whereIn('company_id', $request->companies);
            });
        }

        if ($request->filled('departments')) {
            $users->whereHas('employeeUser.employee', function($query) use ($request) {
                $query->whereIn('department_id', $request->departments);
            });
        }

        if ($request->filled('users')) {
            $users->whereIn('id', $request->users);
        }

        $userIds = $users->pluck('id')->unique();



        // Insere na tabela pivô
        foreach ($userIds as $userId) {
            DB::table('notification_user')->insert([
                'notification_id' => $notification->id,
                'user_id' => $userId,
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Notificação enviada!');
    }

    /**
     * Mark a notification as read for the authenticated user.
     */
    public function markAsRead(Request $request)
    {
        $request->validate(['notification_id' => 'required|integer']);

        $user = auth()->user();
        $notificationId = $request->notification_id;

        $notification = $user->notifications()->where('notification_id', $notificationId)->first();

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notificação não encontrada'], 404);
        }

        $user->notifications()->updateExistingPivot($notificationId, ['is_read' => true]);

        return response()->json(['success' => true]);
    }



    public function unread()
    {
        $user = auth()->user();

        $unreadNotifications = $user->notifications()
            ->wherePivot('is_read', false)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return response()->json([
            'count' => $unreadNotifications->count(),
            'notifications' => $unreadNotifications->map(function($not) {
                return [
                    'id' => $not->id,
                    'title' => $not->title,
                    'message' => $not->message,
                    'created_at' => $not->created_at->format('d/m/Y H:i'),
                ];
            }),
        ]);
    }



}
