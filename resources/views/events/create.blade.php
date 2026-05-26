@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Add New Event</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Event Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Date & Time</label>
                <input type="datetime-local" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Available Slots</label>
                <input type="number" name="slots" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="active">Active</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Event</button>
        </form>
    </div>
</div>
@endsection