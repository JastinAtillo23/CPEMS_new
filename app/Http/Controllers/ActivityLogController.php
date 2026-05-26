<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->get();
        
        $totalActivities = $logs->count();
        $userLogins = $logs->where('action', 'login')->count();
        $eventActions = $logs->where('action', 'like', '%event%')->count();
        $today = $logs->where('created_at', '>=', now()->startOfDay())->count();

        return view('activity_logs.index', compact(
            'logs',
            'totalActivities',
            'userLogins',
            'eventActions',
            'today'
        ));
    }
}