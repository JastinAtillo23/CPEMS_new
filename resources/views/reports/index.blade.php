@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-shell">
        <div class="top-action-panel d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="page-title">Reports & Analytics</h1>
                <p class="subtitle">Events Summary — {{ now()->format('F Y') }}</p>
            </div>
            <button class="btn btn-primary mt-3 mt-md-0">Export PDF</button>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="mb-3 section-heading">Events Held</div>
                    <h2 class="fw-bold">{{ $eventsHeld }}</h2>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="mb-3 section-heading">Total Attendees</div>
                    <h2 class="fw-bold">{{ $totalAttendees }}</h2>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="mb-3 section-heading">Total Registered</div>
                    <h2 class="fw-bold">{{ $totalRegistered }}</h2>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="metric-card p-4">
                    <div class="mb-3 section-heading">Volunteers Deployed</div>
                    <h2 class="fw-bold">{{ $volunteersDeployed }}</h2>
                </div>
            </div>
        </div>

        <div class="table-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="mb-1">Attendance By Events</h5>
                    <p class="subtitle mb-0">Compare attendance across active programs.</p>
                </div>
            </div>

            <div class="row g-3">
                @forelse ($eventStats as $event)
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>{{ $event->title }}</div>
                            <div class="text-white-50">{{ $event->registrations_count }}</div>
                        </div>
                        <div class="progress" style="height: 12px; background-color: rgba(255,255,255,0.08);">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min(100, $event->attendance_rate) }}%;" aria-valuenow="{{ $event->attendance_rate }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-4">No event attendance data available.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
