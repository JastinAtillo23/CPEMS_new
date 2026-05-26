<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPEMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #171a1f;
            color: #e2e8f0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: #0f1318;
            border-right: 1px solid rgba(255,255,255,0.08);
            position: sticky;
            top: 0;
        }
        .sidebar h4 {
            font-size: 1.1rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            padding: 1.6rem 1.75rem 0.75rem;
            margin: 0;
            color: #fff;
        }
        .sidebar a {
            color: #cbd5e1;
            padding: 16px 24px;
            display: block;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255,255,255,0.04);
            color: #fff;
        }
        .sidebar a.active {
            border-left: 4px solid #85a8ff;
            padding-left: 20px;
        }
        .sidebar hr {
            border-top: 1px solid rgba(255,255,255,0.08);
            margin: 1rem 0;
        }
        .content-area {
            min-height: 100vh;
            background: #171a1f;
        }
        .page-shell {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 28px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45);
            padding: 2rem;
            margin-bottom: 2rem;
            width: 100%;
            max-width: 100%;
        }
        .panel-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
        }
        .panel-card .card-body,
        .page-shell .p-4 {
            padding: 1.75rem;
        }
        .metric-card {
            min-height: 140px;
            border-radius: 20px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: #fff;
        }
        .metric-card .d-flex {
            gap: 0.5rem;
        }
        .metric-card .fw-bold {
            font-size: 2.2rem;
        }
        .table-card {
            border-radius: 24px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            overflow: hidden;
        }
        .table-card table {
            color: #e2e8f0;
            background: transparent;
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }
        .table-card thead {
            background: transparent;
            color: #94a3b8;
        }
        .table-card thead th {
            color: #cbd5e1;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            padding-bottom: 0.75rem;
        }
        .table-card tbody tr {
            background: rgba(255,255,255,0.05);
            border-bottom: none;
        }
        .table-card tbody tr:hover {
            background-color: rgba(255,255,255,0.08);
        }
        .table-card tbody td {
            color: #e2e8f0;
            border: none;
        }
        .top-action-panel {
            border-radius: 20px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: #ffffff;
            padding: 1.5rem 1.75rem;
        }
        .top-action-panel h1,
        .top-action-panel p,
        .top-action-panel a {
            color: #ffffff;
        }
        .top-action-panel .btn-add {
            min-width: 135px;
        }
        .btn-dark.custom {
            background-color: #11151b;
            border-color: #11151b;
            color: #fff;
        }
        .btn-dark.custom:hover {
            background-color: #0d1115;
            border-color: #0d1115;
        }
        .btn-primary {
            background-color: #FFB703;
            border-color: #FFB703;
            color: #0f172a;
        }
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #FF9F00;
            border-color: #FF9F00;
            color: #0f172a;
        }
        .form-control,
        .form-select,
        textarea.form-control {
            border-radius: 12px;
            border: 1px solid rgba(15,23,42,0.15);
            background-color: rgba(255,255,255,0.96);
            color: #0f172a;
            box-shadow: none;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #FFB703;
            box-shadow: 0 0 0 0.15rem rgba(255,183,3,0.2);
        }
        .form-control::placeholder {
            color: rgba(15,23,42,0.45);
        }
        .form-label,
        .form-text {
            color: #0f172a;
        }
        .form-select option {
            color: #0f172a;
            background: #fff;
        }
        .table th,
        .table td {
            border-top: none;
        }
        .page-title {
            color: #f8fafc;
            margin-bottom: 0.25rem;
        }

        .app-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .app-header h1 {
            margin: 0;
            font-size: 1.4rem;
            color: #f8fafc;
        }
        .app-header .user-badge {
            background: rgba(255,255,255,0.04);
            padding: 0.65rem 1rem;
            border-radius: 14px;
            color: #cbd5e1;
            font-size: 0.95rem;
        }

        @media (max-width: 1199px) {
            .sidebar {
                position: relative;
                min-height: auto;
            }
            .page-shell {
                padding: 1.5rem;
            }
            .top-action-panel {
                padding: 1.2rem;
            }
            .metric-card {
                min-height: 130px;
            }
        }

        @media (max-width: 991px) {
            .sidebar {
                display: none !important;
            }
            .content-area {
                padding: 1.5rem 1rem;
            }
            .page-shell {
                border-radius: 20px;
            }
            .top-action-panel {
                flex-direction: column;
                align-items: flex-start;
            }
            .top-action-panel h1 {
                font-size: 1.3rem;
            }
            .btn-primary {
                width: 100%;
            }
            .app-header {
                flex-direction: column;
                align-items: stretch;
            }
        }

        @media (max-width: 767px) {
            .container-fluid {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            .content-area {
                padding: 1rem;
            }
            .page-shell,
            .table-card,
            .metric-card {
                border-radius: 18px;
            }
            .table-card table {
                font-size: 0.92rem;
            }
            .sidebar a {
                padding: 12px 16px;
            }
        }
        .subtitle {
            color: #94a3b8;
            margin-bottom: 0;
        }
        .status-chip {
            border-radius: 999px;
            padding: 0.35rem 0.85rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        .status-open { background-color: #064e3b; color: #bbf7d0; }
        .status-full { background-color: #7f1d1d; color: #ffdede; }
        .status-upcoming { background-color: #0b3d91; color: #bfdbfe; }
        .badge-soft {
            background-color: rgba(255,255,255,0.08);
            color: #cbd5e1;
        }
        .section-heading {
            font-size: 1rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0 d-none d-md-block">
                <h4 class="text-white p-3">CPEMS</h4>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'active' : '' }}"><i class="bi bi-calendar-event"></i> Events</a>
                <a href="{{ route('registrations.my') }}" class="{{ request()->routeIs('registrations.my') ? 'active' : '' }}"><i class="bi bi-bookmark-check"></i> My Registrations</a>
                @if(auth()->check() && in_array(auth()->user()->role->name, ['admin', 'organizer']))
                    <a href="{{ route('registrations.manage') }}" class="{{ request()->routeIs('registrations.manage') ? 'active' : '' }}"><i class="bi bi-clipboard-data"></i> Manage Registrations</a>
                @endif
                <a href="{{ route('volunteers.index') }}" class="{{ request()->routeIs('volunteers.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Volunteers</a>
                <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.index') ? 'active' : '' }}"><i class="bi bi-bar-chart"></i> Reports</a>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><i class="bi bi-person-gear"></i> Users</a>
                <a href="{{ route('users.roleAccounts') }}" class="{{ request()->routeIs('users.roleAccounts') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Role Accounts</a>
                <a href="{{ route('activity_logs.index') }}" class="{{ request()->routeIs('activity_logs.index') ? 'active' : '' }}"><i class="bi bi-list-check"></i> Activity Log</a>
                <hr class="text-white">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            <!-- Offcanvas for Mobile -->
            <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="mobileSidebarLabel">CPEMS</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <a href="{{ route('dashboard') }}" class="d-block mb-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    <a href="{{ route('events.index') }}" class="d-block mb-2 {{ request()->routeIs('events.*') ? 'active' : '' }}"><i class="bi bi-calendar-event"></i> Events</a>
                    <a href="{{ route('registrations.my') }}" class="d-block mb-2 {{ request()->routeIs('registrations.my') ? 'active' : '' }}"><i class="bi bi-bookmark-check"></i> My Registrations</a>
                    @if(auth()->check() && in_array(auth()->user()->role->name, ['admin', 'organizer']))
                        <a href="{{ route('registrations.manage') }}" class="d-block mb-2 {{ request()->routeIs('registrations.manage') ? 'active' : '' }}"><i class="bi bi-clipboard-data"></i> Manage Registrations</a>
                    @endif
                    <a href="{{ route('volunteers.index') }}" class="d-block mb-2 {{ request()->routeIs('volunteers.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Volunteers</a>
                    <a href="{{ route('reports.index') }}" class="d-block mb-2 {{ request()->routeIs('reports.index') ? 'active' : '' }}"><i class="bi bi-bar-chart"></i> Reports</a>
                    <a href="{{ route('users.index') }}" class="d-block mb-2 {{ request()->routeIs('users.index') ? 'active' : '' }}"><i class="bi bi-person-gear"></i> Users</a>
                    <a href="{{ route('users.roleAccounts') }}" class="d-block mb-2 {{ request()->routeIs('users.roleAccounts') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Role Accounts</a>
                    <a href="{{ route('activity_logs.index') }}" class="d-block mb-2 {{ request()->routeIs('activity_logs.index') ? 'active' : '' }}"><i class="bi bi-list-check"></i> Activity Log</a>
                    <hr>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>

            <div class="col-md-9 col-lg-10 content-area p-4">
                <button class="btn btn-outline-light d-md-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">Menu</button>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
            @else
            <!-- Guest / unauthenticated view: full width content -->
            <div class="col-12 content-area p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
            @endauth
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>