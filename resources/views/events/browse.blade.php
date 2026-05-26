@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h3 class="mb-0">Browse Events</h3>
        <div class="d-flex gap-2 flex-wrap">
            <input type="text" id="searchInput" class="form-control w-auto"
                   placeholder="Search events...">
            <select id="categoryFilter" class="form-select w-auto">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <select id="sortFilter" class="form-select w-auto">
                <option value="asc">Sort by: Soonest</option>
                <option value="desc">Sort by: Latest</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <p id="eventCount">{{ $events->count() }} events found</p>

        <div class="row" id="eventsGrid">
            @forelse($events as $event)
            <div class="col-md-4 col-sm-6 mb-4 event-card"
                 data-title="{{ strtolower($event->title) }}"
                 data-category="{{ $event->category->name ?? '' }}"
                 data-date="{{ $event->date }}">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <span class="badge bg-primary">
                            {{ $event->category->name ?? 'Uncategorized' }}
                        </span>
                        <h5 class="mt-2">{{ $event->title }}</h5>
                        <p class="text-muted mb-1">
                            <i class="bi bi-calendar"></i>
                            {{ \Carbon\Carbon::parse($event->date)->format('M d, Y h:i A') }}
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-geo-alt"></i> {{ $event->location }}
                        </p>
                        <p class="mb-3">
                            Slots: {{ $event->slots }} |
                            Registered: {{ $event->registrations->count() }}
                        </p>

                        @if($event->registrations->count() < $event->slots)
                            <form action="{{ route('registrations.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <button class="btn btn-primary w-100">Register Now</button>
                            </form>
                        @else
                            <button class="btn btn-secondary w-100" disabled>
                                Registration Closed
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted py-4">No active events available.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    const searchInput    = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const sortFilter     = document.getElementById('sortFilter');
    const eventsGrid     = document.getElementById('eventsGrid');
    const eventCount     = document.getElementById('eventCount');

    function filterEvents() {
        const search   = searchInput.value.toLowerCase();
        const category = categoryFilter.value.toLowerCase();
        const cards    = Array.from(eventsGrid.querySelectorAll('.event-card'));

        let visible = 0;
        cards.forEach(card => {
            const title    = card.dataset.title;
            const cat      = card.dataset.category.toLowerCase();
            const matchSearch   = title.includes(search);
            const matchCategory = category === '' || cat === category;

            if (matchSearch && matchCategory) {
                card.style.display = '';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        eventCount.textContent = visible + ' events found';

        // Sort
        const sorted = cards
            .filter(c => c.style.display !== 'none')
            .sort((a, b) => {
                const da = new Date(a.dataset.date);
                const db = new Date(b.dataset.date);
                return sortFilter.value === 'asc' ? da - db : db - da;
            });

        sorted.forEach(card => eventsGrid.appendChild(card));
    }

    searchInput.addEventListener('input', filterEvents);
    categoryFilter.addEventListener('change', filterEvents);
    sortFilter.addEventListener('change', filterEvents);
</script>
@endsection