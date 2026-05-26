@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold">My Registrations</h2>
            @if(auth()->check() && in_array(auth()->user()->role->name, ['admin', 'organizer']))
                <p class="text-muted mb-0">As an admin or organizer, you can manage all registrations from the panel below.</p>
            @endif
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('events.browse') }}" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Browse Events
            </a>
            @if(auth()->check() && in_array(auth()->user()->role->name, ['admin', 'organizer']))
                <a href="{{ route('registrations.manage') }}" class="btn btn-primary">
                    <i class="bi bi-clipboard-data"></i> Manage Registrations
                </a>
            @endif
        </div>
    </div>

    <!-- 🎛 Status Tabs -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-fill border-0" id="statusTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-semibold py-3" data-bs-toggle="tab" data-bs-target="#all" type="button">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold py-3" data-bs-toggle="tab" data-bs-target="#pending" type="button">Pending</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold py-3" data-bs-toggle="tab" data-bs-target="#confirmed" type="button">Confirmed</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold py-3" data-bs-toggle="tab" data-bs-target="#cancelled" type="button">Cancelled</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold py-3" data-bs-toggle="tab" data-bs-target="#attended" type="button">Attended</button>
                </li>
            </ul>
        </div>
    </div>

    <!-- 📋 Registration List -->
    <div class="tab-content" id="tabContent">
        @foreach([
            'all' => $registrations,
            'pending' => $registrations->where('status','pending'),
            'confirmed' => $registrations->where('status','confirmed'),
            'cancelled' => $registrations->where('status','cancelled'),
            'attended' => $registrations->where('status','attended')
        ] as $key => $list)
        <div class="tab-pane fade {{ $key == 'all' ? 'show active' : '' }}" id="{{ $key }}">
            @forelse($list as $reg)
            <div class="card border-0 shadow-sm mb-3 overflow-hidden">
                <div class="card-body p-0 d-flex">
                    <!-- Colored Left Border -->
                    <div class="w-2" style="width:8px; 
                        @if($reg->status == 'pending') background-color: #ffc107;
                        @elseif($reg->status == 'confirmed') background-color: #198754;
                        @elseif($reg->status == 'cancelled') background-color: #dc3545;
                        @elseif($reg->status == 'attended') background-color: #0dcaf0;
                        @endif">
                    </div>

                    <div class="p-4 flex-grow-1 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">{{ optional($reg->event)->title ?? 'Unknown Event' }}</h5>
                            <p class="text-muted small mb-1">
                                {{ optional(optional($reg->event)->date)->format('M d, Y') ?? 'TBA' }} • 
                                {{ optional($reg->event)->location ?? 'Location pending' }} • 
                                {{ optional($reg->event->category)->name ?? 'General' }}
                            </p>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="badge rounded-pill" style="background-color: #fff3cd; color: #0f172a;">{{ ucfirst($reg->payment_status ?? 'unpaid') }}</span>
                                <span class="badge rounded-pill" style="background-color: #f8f9fa; color: #0f172a;">{{ ucfirst($reg->status) }}</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            @if(($reg->payment_status ?? 'unpaid') !== 'paid' && $reg->status !== 'cancelled')
                                <form action="{{ route('registrations.pay', $reg) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary px-3">Pay</button>
                                </form>
                            @endif

                            @if($reg->status != 'cancelled' && $reg->status != 'attended')
                            <form action="{{ route('registrations.cancel', $reg) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger px-3">Cancel</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5 text-muted">
                    <i class="bi bi-calendar-x fs-1 mb-3 d-block"></i>
                    <p class="mb-0">No registrations found in this category.</p>
                </div>
            </div>
            @endforelse
        </div>
        @endforeach
    </div>
</div>
@endsection