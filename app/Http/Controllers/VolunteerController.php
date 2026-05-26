<?php
namespace App\Http\Controllers;

use App\Models\VolunteerAssignment;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class VolunteerController extends Controller {

    public function index() {
        $assignments = VolunteerAssignment::with(['user', 'event'])
            ->latest()
            ->get();

        $pending  = $assignments->where('status', 'pending')->count();
        $accepted = $assignments->where('status', 'accepted')->count();
        $upcoming = VolunteerAssignment::where('status', 'accepted')
            ->whereHas('event', function($q) {
                $q->where('date', '>=', now());
            })->count();

        return view('volunteers.index', compact('assignments', 'pending', 'accepted', 'upcoming'));
    }

    public function create() {
        $users = User::whereHas('role', function($q) {
            $q->where('name', 'volunteer');
        })->get();

        $events = Event::where('status', 'active')->get();

        return view('volunteers.create', compact('users', 'events'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id'  => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'task'     => 'required|string|max:255'
        ]);

        VolunteerAssignment::create([
            'user_id'  => $request->user_id,
            'event_id' => $request->event_id,
            'task'     => $request->task,
            'status'   => 'pending'
        ]);

        return redirect()->route('volunteers.index')
            ->with('success', 'Volunteer assigned successfully!');
    }

    public function updateStatus(Request $request, VolunteerAssignment $volunteer) {
        $request->validate([
            'status' => 'required|in:pending,accepted,declined'
        ]);

        $volunteer->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully!');
    }

    public function destroy(VolunteerAssignment $volunteer) {
        $volunteer->delete();
        return back()->with('success', 'Assignment removed successfully!');
    }
}