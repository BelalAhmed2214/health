<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ __('direction') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Healthcare System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .form-control,
        .form-select {
            border: 1.5px solid #b0bec5 !important;
            /* Rich, visible slate-grey border */
            background-color: #fdfdfd;
            /* Slight off-white to make the field pop */
        }

        /* When clicking inside the input fields */
        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd !important;
            /* Classic bright Bootstrap blue */
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
            background-color: #ffffff;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-heart-pulse-fill me-2"></i>{{ __('HealthCare Clinic') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-semibold' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i>{{ __('Dashboard') }}
                        </a>
                    </li>
                    @if(Auth::check() && Auth::user()->isSuperAdmin())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active fw-semibold' : '' }}" href="{{ route('users.index') }}">
                            <i class="bi bi-person-badge me-1"></i>{{ __('Users') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prices.*') ? 'active fw-semibold' : '' }}" href="{{ route('prices.index') }}">
                            <i class="bi bi-currency-dollar me-1"></i>{{ __('Prices') }}
                        </a>
                    </li>
                    @endif
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patients.*') ? 'active fw-semibold' : '' }}" href="{{ route('patients.index') }}">
                            <i class="bi bi-people me-1"></i>{{ __('Patients') }}
                        </a>
                    </li>
                    @endauth
                    @auth
                    <li class="nav-item ms-3 dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text text-muted small">{{ Auth::user()->email }}</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    {{-- Language Toggle --}}
                    <li class="nav-item ms-2">
                        <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                            class="btn btn-sm btn-outline-light fw-semibold">
                            <i class="bi bi-translate me-1"></i>{{ __('locale_label') }}
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/packages/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>