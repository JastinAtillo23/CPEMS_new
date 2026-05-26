<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Only restrict create/store/edit/update/destroy to admin/organizer
        $this->middleware('role:admin,organizer')->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    // Admin/Organizer: list all events (all statuses)
    public function index()
    {
        $events = Event::with(['category', 'registrations'])->get();
        $categories = Category::all();
        return view('events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date'        => 'required|date',
            'location'    => 'required|string',
            'slots'       => 'required|integer|min:1',
            'status'      => 'required|in:active,draft,archived'
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date'        => 'required|date',
            'location'    => 'required|string',
            'slots'       => 'required|integer|min:1',
            'status'      => 'required|in:active,draft,archived'
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }

    // All users: browse only active events
    public function browse()
    {
        $events = Event::with(['category', 'registrations'])
            ->where('status', 'active')
            ->latest()
            ->get();
        $categories = Category::all();
        return view('events.browse', compact('events', 'categories'));
    }
}