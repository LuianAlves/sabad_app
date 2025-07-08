<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;

use App\Models\Business\Employee\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;


use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $limitDate = Carbon::now()->subDays(90);

        $recentEmployees = Employee::with('department')->where('hired_in', '>=', $limitDate)->orderBy('hired_in', 'desc')->get();

        $recentEmployees->each(function ($employee) {
            $employee->hired_in = Carbon::parse($employee->hired_in)->diffForhumans();
        });


        /* Online Users */
        $minutes = config('session.lifetime');
        $onlineUserIds = DB::table('sessions')
            ->where('last_activity', '>=', now()->subMinutes($minutes)->timestamp)
            ->pluck('user_id')
            ->unique()
            ->filter();

        $onlineUsers = User::whereIn('id', $onlineUserIds)->get();
        $onlineCount = $onlineUsers->count();

        return view("app.dashboard", compact(
            "recentEmployees",
            "onlineUsers",
            "onlineCount"
        ));
    }
}
