@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-shell">
        <div class="top-action-panel d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="subtitle mb-0">Overview of events, registrations, and volunteer capacity.</p>
            </div>
            <a href="{{ route('events.create') }}" class="btn btn-warning mt-3 mt-md-0">+ Add Event</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="section-heading">Active Events</div>
                    <h2 class="fw-bold">{{ $activeEvents }}</h2>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="section-heading">Volunteers</div>
                    <h2 class="fw-bold">{{ $volunteerCount }}</h2>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="section-heading">Participants</div>
                    <h2 class="fw-bold">{{ $participantCount }}</h2>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="section-heading">Programs</div>
                    <h2 class="fw-bold">{{ $programsCount }}</h2>
                </div>
            </div>
        </div>

        <div class="table-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="mb-1">Event Overview</h5>
                    <p class="subtitle mb-0">Latest events and current capacity.</p>
                </div>
                <a href="{{ route('events.index') }}" class="btn btn-dark btn-sm">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3 text-dark">Events</th>
                            <th class="text-dark">Date</th>
                            <th class="text-dark">Location</th>
                            <th class="text-dark">Slots</th>
                            <th class="text-dark">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                        <tr>
                            <td class="ps-3 fw-semibold text-dark">{{ $event->title }}</td>
                            <td class="text-dark">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                            <td class="text-dark">{{ $event->location }}</td>
                            <td class="text-dark">{{ $event->slots }}</td>
                            <td>
                                @php
                                    $status = strtolower($event->status);
                                    $statusClass = $status === 'full'
                                        ? 'status-full'
                                        : ($status === 'upcoming'
                                            ? 'status-upcoming'
                                            : 'status-open');
                                @endphp
                                <span class="status-chip {{ $statusClass }}">{{ ucfirst($status) }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-dark">No events found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection