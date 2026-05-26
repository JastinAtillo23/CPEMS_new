@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Event</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Event Title</label>
                <input type="text" name="title" value="{{ $event->title }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $event->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Date & Time</label>
                <input type="datetime-local" name="date" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d\\TH:i') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" value="{{ $event->location }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Available Slots</label>
                <input type="number" name="slots" value="{{ $event->slots }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="archived" {{ $event->status == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>
</div>
@endsection