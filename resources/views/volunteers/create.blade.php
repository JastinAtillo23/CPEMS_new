@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="page-shell">

        <div class="mb-4">
            <h1 class="page-title">Assign Volunteer</h1>
            <p class="subtitle mb-0">Assign a volunteer to an event with a specific task.</p>
        </div>

        <div class="table-card p-4" style="max-width: 600px;">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('volunteers.store') }}" method="POST">
                @csrf

                {{-- Event --}}
                <div class="mb-3">
                    <label class="form-label text-white">Event</label>
                    <select name="event_id" class="form-select @error('event_id') is-invalid @enderror">
                        <option value="">— Select Event —</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}"
                                {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Volunteer --}}
                <div class="mb-3">
                    <label class="form-label text-white">Volunteer</label>
                    <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                        <option value="">— Select Volunteer —</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Task --}}
                <div class="mb-4">
                    <label class="form-label text-white">Task</label>
                    <input type="text" name="task"
                           class="form-control @error('task') is-invalid @enderror"
                           placeholder="e.g. First Aid support"
                           value="{{ old('task') }}">
                    @error('task')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Assign Volunteer</button>
                    <a href="{{ route('volunteers.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection