@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Manage Registrations</h2>
            <p class="text-muted mb-0">Update registration statuses, mark payments, and keep your event roster current.</p>
        </div>
        <a href="{{ route('registrations.my') }}" class="btn btn-outline-primary">
            <i class="bi bi-bookmark-check"></i> My Registrations
        </a>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Participant</th>
                        <th>Event</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-semibold">{{ optional($registration->user)->name ?? 'Unknown' }}</div>
                                <div class="text-muted small">{{ optional($registration->user)->email ?? 'No email' }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ optional($registration->event)->title ?? 'Unknown Event' }}</div>
                                <div class="text-muted small">
                                    {{ optional(optional($registration->event)->date)->format('M d, Y') ?? 'TBA' }} •
                                    {{ optional($registration->event)->location ?? 'Location pending' }}
                                </div>
                                <span class="badge bg-secondary mt-1">{{ optional(optional($registration->event)->category)->name ?? 'General' }}</span>
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $registration->payment_status === 'paid' ? 'success' : 'warning' }} text-dark">
                                    {{ ucfirst($registration->payment_status ?? 'unpaid') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $registration->status === 'confirmed' ? 'success' : ($registration->status === 'attended' ? 'info' : ($registration->status === 'cancelled' ? 'danger' : 'secondary')) }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end align-items-end">
                                    <form action="{{ route('registrations.update', $registration) }}" method="POST" class="d-flex gap-2 align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm">
                                            @foreach(['pending','confirmed','attended','cancelled'] as $status)
                                                <option value="{{ $status }}" {{ $registration->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                                    </form>
                                    @if(($registration->payment_status ?? 'unpaid') !== 'paid' && $registration->status !== 'cancelled')
                                        <form action="{{ route('registrations.pay', $registration) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">Mark Paid</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">No registrations exist yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
