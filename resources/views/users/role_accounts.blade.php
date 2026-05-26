@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h1 class="mb-3">Role Accounts</h1>
        <p class="text-muted">Review the default account assigned to each role and confirm access for admin, organizer, volunteer, and participant users.</p>
    </div>

    <div class="card rounded-4 shadow-sm mb-4 border-0">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="card-title mb-2">Default Role Accounts</h5>
                    <p class="text-muted mb-0">These are the seeded accounts for each role. You can edit or delete them from the main Users page.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Role</th>
                            <th>Account Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            @php $account = $role->users->first(); @endphp
                            <tr>
                                <td class="fw-semibold">{{ ucfirst($role->name) }}</td>
                                <td>{{ $account->name ?? 'Not created yet' }}</td>
                                <td>{{ $account->email ?? '—' }}</td>
                                <td>
                                    @if($account)
                                        <span class="badge {{ $account->status === 'active' ? 'bg-success' : 'bg-secondary' }} px-3 py-2">
                                            {{ ucfirst($account->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2">Missing</span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    @if($account)
                                        Default seeded account for {{ $role->name }} role
                                    @else
                                        Create a user for this role on the Users page.
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No roles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection