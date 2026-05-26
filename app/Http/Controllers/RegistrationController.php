<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Event;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function myRegistrations()
    {
        $registrations = Registration::where('user_id', auth()->id())
            ->with('event.category')
            ->latest()
            ->get();
            
        return view('registrations.my', compact('registrations'));
    }

    public function manageRegistrations()
    {
        $registrations = Registration::with(['user', 'event.category'])
            ->latest()
            ->get();

        return view('registrations.manage', compact('registrations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id'
        ]);

        // Check if already registered
        $exists = Registration::where('user_id', auth()->id())
                    ->where('event_id', $request->event_id)
                    ->exists();

        if($exists){
            return back()->with('error', 'You are already registered for this event.');
        }

        Registration::create([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        return back()->with('success', 'Successfully registered!');
    }

    public function pay(Registration $registration)
    {
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        if ($registration->status === 'cancelled') {
            return back()->with('error', 'Cannot pay for a cancelled registration.');
        }

        if ($registration->payment_status === 'paid') {
            return back()->with('info', 'This registration is already paid.');
        }

        $registration->update(['payment_status' => 'paid']);
        return back()->with('success', 'Payment completed successfully.');
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        if (!in_array(auth()->user()->role->name, ['admin', 'organizer'])) {
            abort(403);
        }
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,attended,cancelled'
        ]);

        $registration->update(['status' => $request->status]);
        return back()->with('success', 'Status updated successfully.');
    }

    public function cancel(Registration $registration)
    {
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        if($registration->status == 'attended'){
            return back()->with('error', 'Cannot cancel — you already attended this event.');
        }

        $registration->update(['status' => 'cancelled']);
        return back()->with('success', 'Registration cancelled successfully.');
    }
}