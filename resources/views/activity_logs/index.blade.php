@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Activity Logs</h1>

    <!-- Summary Statistics -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Activities</h5>
                    <h2>{{ $totalActivities }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">User Logins</h5>
                    <h2>{{ $userLogins }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Event Actions</h5>
                    <h2>{{ $eventActions }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Today's Activities</h5>
                    <h2>{{ $today }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Logs Table -->
    <div class="mt-5">
        <h3>Recent Activities</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->user->name ?? 'System' }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($log->action) }}</span>
                        </td>
                        <td>{{ $log->description ?? '-' }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No activity logs found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
