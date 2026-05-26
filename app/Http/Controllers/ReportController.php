<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\VolunteerAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $eventsHeld = Event::count();
        $totalAttendees = Registration::where('status', 'attended')->count();
        $volunteersDeployed = VolunteerAssignment::where('status', 'accepted')->count();

        $totalSlots = Event::sum('slots');
        $totalRegistered = Registration::count();
        $avgFillRate = $totalSlots > 0 ? round(($totalRegistered / $totalSlots) * 100) : 0;
        $avgAttendanceRate = $totalSlots > 0 ? round(($totalAttendees / $totalSlots) * 100) : 0;

        $eventStats = Event::withCount('registrations')
            ->with(['registrations' => function ($q) {
                $q->where('status', 'attended');
            }])
            ->get()
            ->map(function ($event) {
                $event->attended_count = $event->registrations->count();
                $event->attendance_rate = $event->slots > 0 ? round(($event->attended_count / $event->slots) * 100) : 0;
                $event->formatted_date = Carbon::parse($event->date)->format('M d, Y');
                return $event;
            });

        return view('reports.index', compact(
            'eventsHeld',
            'totalAttendees',
            'volunteersDeployed',
            'totalSlots',
            'totalRegistered',
            'avgFillRate',
            'avgAttendanceRate',
            'eventStats'
        ));
    }
}