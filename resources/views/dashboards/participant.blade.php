@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-shell">
        <div class="top-action-panel d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="page-title">Participant Dashboard</h1>
                <p class="subtitle mb-0">Track your event registrations and attendance.</p>
            </div>
            <a href="{{ route('registrations.my') }}" class="btn btn-primary mt-3 mt-md-0">My Registrations</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Total Registrations</div>
                    <h2 class="fw-bold">{{ $registrations->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Attended</div>
                    <h2 class="fw-bold">{{ $attendedCount }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Pending</div>
                    <h2 class="fw-bold">{{ $pendingCount }}</h2>
                </div>
            </div>
        </div>

        <div class="table-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="mb-1">Upcoming Events</h5>
                    <p class="subtitle mb-0">Your next registered events.</p>
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
                        @forelse ($upcomingRegistrations as $registration)
                            <tr>
                                <td class="ps-3 text-white">{{ $registration->event->title ?? 'Deleted event' }}</td>
                                <td>{{ optional($registration->event)->date?->format('M d, Y') ?? 'N/A' }}</td>
                                <td>{{ ucfirst($registration->status) }}</td>
                                <td>{{ $registration->event->location ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">No upcoming registrations.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection