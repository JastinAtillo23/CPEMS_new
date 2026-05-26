<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user     = auth()->user();
        $roleName = strtolower($user->role->name ?? 'guest');

        switch ($roleName) {
            case 'admin':
                $data = [
                    'activeEvents'     => Event::where('status', 'active')->count(),
                    'volunteerCount'   => User::whereHas('role', fn($q) => $q->where('name', 'volunteer'))->count(),
                    'participantCount' => User::whereHas('role', fn($q) => $q->where('name', 'participant'))->count(),
                    'programsCount'    => Category::count(),
                    'events'           => Event::withCount('registrations')->orderBy('registrations_count', 'desc')->take(5)->get(),
                    'popularEvents'    => Event::withCount('registrations')->orderBy('registrations_count', 'desc')->take(5)->get(),
                ];
                break;

            case 'organizer':
                $data = [
                    'activeEvents'     => Event::where('status', 'active')->count(),
                    'volunteerCount'   => User::whereHas('role', fn($q) => $q->where('name', 'volunteer'))->count(),
                    'participantCount' => User::whereHas('role', fn($q) => $q->where('name', 'participant'))->count(),
                    'programsCount'    => Category::count(),
                    'events'           => Event::withCount('registrations')->orderBy('registrations_count', 'desc')->take(5)->get(),
                    'popularEvents'    => Event::withCount('registrations')->orderBy('registrations_count', 'desc')->take(5)->get(),
                ];
                break;

            case 'volunteer':
                $assignments = $user->volunteerAssignments()->with('event')->get();
                $data = [
                    'assignments'         => $assignments,
                    'acceptedAssignments' => $assignments->where('status', 'accepted')->count(),
                    'pendingAssignments'  => $assignments->where('status', 'pending')->count(),
                    'upcomingAssignments' => $assignments->filter(fn($a) => $a->event && $a->event->date >= now()),
                ];
                break;

            case 'participant':
                $registrations = $user->registrations()->with('event')->get();
                $data = [
                    'registrations'        => $registrations,
                    'attendedCount'        => $registrations->where('status', 'attended')->count(),
                    'pendingCount'         => $registrations->where('status', 'pending')->count(),
                    'upcomingRegistrations'=> $registrations->filter(fn($r) => $r->event && $r->event->date >= now()),
                ];
                break;

            default:
                return view('home');
        }

        $viewName = "dashboards.{$roleName}";
        if (!view()->exists($viewName)) {
            return view('home');
        }

        return view($viewName, $data);
    }
}