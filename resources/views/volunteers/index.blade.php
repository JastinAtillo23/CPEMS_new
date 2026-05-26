@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-shell">

        {{-- Header --}}
        <div class="top-action-panel d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <div>
                <h1 class="page-title">Volunteer Coordination</h1>
                <p class="subtitle mb-0">Review assignments, volunteer tasks, and current status.</p>
            </div>
            <a href="{{ route('volunteers.create') }}" class="btn btn-warning mt-3 mt-md-0">+ Assign</a>
        </div>

        {{-- Stats --}}
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="table-card p-3 text-center">
                    <h6 class="text-dark mb-1">Pending</h6>
                    <h3 class="text-warning mb-0">{{ $pending }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="table-card p-3 text-center">
                    <h6 class="text-dark mb-1">Accepted</h6>
                    <h3 class="text-success mb-0">{{ $accepted }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="table-card p-3 text-center">
                    <h6 class="text-dark mb-1">Upcoming</h6>
                    <h3 class="text-info mb-0">{{ $upcoming }}</h3>
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        {{-- Table --}}
        <div class="table-card p-4">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3 text-dark">Event</th>
                            <th class="text-dark">Task</th>
                            <th class="text-dark">Volunteer</th>
                            <th class="text-dark">Status</th>
                            <th class="text-dark">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                        <tr>
                            <td class="ps-3 fw-semibold text-dark">
                                {{ $assignment->event->title ?? '— No Event —' }}
                            </td>
                            <td class="text-dark">{{ $assignment->task }}</td>
                            <td class="text-dark">{{ $assignment->user->name ?? '— No User —' }}</td>
                            <td>
                                @php $status = strtolower($assignment->status); @endphp
                                @if($status === 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @elseif($status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($status === 'declined')
                                    <span class="badge bg-danger">Declined</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($assignment->status) }}</span>
                                @endif
                            </td>
                            <td>
                                {{-- Update Status --}}
                                <form action="{{ route('volunteers.updateStatus', $assignment) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm d-inline w-auto"
                                            onchange="this.form.submit()">
                                        <option value="pending"  {{ $assignment->status === 'pending'  ? 'selected' : '' }}>Pending</option>
                                        <option value="accepted" {{ $assignment->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="declined" {{ $assignment->status === 'declined' ? 'selected' : '' }}>Declined</option>
                                    </select>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('volunteers.destroy', $assignment) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Remove this assignment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger ms-1">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-dark">
                                No volunteer assignments yet.
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