@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-shell">
        <div class="top-action-panel d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="page-title">Volunteer Dashboard</h1>
                <p class="subtitle mb-0">View your assignments and upcoming volunteer events.</p>
            </div>
            <a href="{{ route('volunteers.index') }}" class="btn btn-primary mt-3 mt-md-0">Volunteer Assignments</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Total Assignments</div>
                    <h2 class="fw-bold">{{ $assignments->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Accepted</div>
                    <h2 class="fw-bold">{{ $acceptedAssignments }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Pending</div>
                    <h2 class="fw-bold">{{ $pendingAssignments }}</h2>
                </div>
            </div>
        </div>

        <div class="table-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="mb-1">Upcoming Volunteer Events</h5>
                    <p class="subtitle mb-0">Your next scheduled volunteer tasks.</p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">Event</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($upcomingAssignments as $assignment)
                            <tr>
                                <td class="ps-3 text-white">{{ $assignment->event->title ?? 'Deleted event' }}</td>
                                <td>{{ optional($assignment->event)->date?->format('M d, Y') ?? 'N/A' }}</td>
                                <td>{{ ucfirst($assignment->status) }}</td>
                                <td>{{ $assignment->event->location ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">No upcoming volunteer events.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection