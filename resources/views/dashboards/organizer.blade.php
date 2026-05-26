@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-shell">

        {{-- Header --}}
        <div class="top-action-panel d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="page-title">Organizer Dashboard</h1>
                <p class="subtitle mb-0">Monitor events, registrations, and volunteer coordination.</p>
            </div>
            <a href="{{ route('events.index') }}" class="btn btn-warning mt-3 mt-md-0">Manage Events</a>
        </div>

        {{-- Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Active Events</div>
                    <h2 class="fw-bold">{{ $activeEvents }}</h2>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Volunteers</div>
                    <h2 class="fw-bold">{{ $volunteerCount }}</h2>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Participants</div>
                    <h2 class="fw-bold">{{ $participantCount }}</h2>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="metric-card p-4 text-center">
                    <div class="section-heading">Programs</div>
                    <h2 class="fw-bold">{{ $programsCount }}</h2>
                </div>
            </div>
        </div>

        {{-- Most Registered Events Table --}}
        <div class="table-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="mb-1">Most Registered Events</h5>
                    <p class="subtitle mb-0">Top events by registration volume.</p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3 text-dark">Event</th>
                            <th class="text-dark">Date</th>
                            <th class="text-dark">Slots</th>
                            <th class="text-dark">Registrations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($popularEvents as $event)
                        <tr>
                            <td class="ps-3 fw-semibold text-dark">{{ $event->title }}</td>
                            <td class="text-dark">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                            <td class="text-dark">{{ $event->slots }}</td>
                            <td class="text-dark">{{ $event->registrations_count }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-dark">
                                No events available yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection