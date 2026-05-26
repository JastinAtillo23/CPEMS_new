@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">All Events</h3>
        <a href="{{ route('events.create') }}" class="btn btn-warning">+ Add</a>
    </div>
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category->name ?? 'N/A' }}</td>
                    <td>
                        @if($event->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @elseif($event->status === 'draft')
                            <span class="badge bg-primary">Draft</span>
                        @else
                            <span class="badge bg-danger">Archived</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('events.edit', $event) }}"
                           class="btn btn-sm btn-dark">Edit</a>
                        <form action="{{ route('events.destroy', $event) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No events found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection