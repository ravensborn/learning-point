<!doctype html>

<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }}</title>

    <script>
        const theme = localStorage.getItem('theme');
        if (theme) {
            document.documentElement.setAttribute("data-bs-theme", theme)
        }
    </script>

    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    {{--    <link href="{{ asset('theme/css/tabler-flags.min.css') }}" rel="stylesheet"/>--}}
    {{--    <link href="{{ asset('theme/css/tabler-payments.min.css') }}" rel="stylesheet"/>--}}
    {{--    <link href="{{ asset('theme/css/tabler-vendors.min.css')  }}" rel="stylesheet"/>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .ti-custom {
            font-size: 1.25rem;
        }


        @media (min-width: 768px) {
            .table-responsive {
                overflow: visible;
            }
        }

        .pagination {
            margin-bottom: 0 !important;
        }

        .dropdown-toggle-link {
            cursor: pointer;
            text-decoration: none;

        }

        .dropdown-toggle-link:after {
            margin-left: 3px;
        }

    </style>
</head>
<body>

<div class="page">
    <!-- Sidebar -->
    <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                    aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <a href="{{ route('home') }}">
                    {{--                    <img src="{{ asset('images/logo.png') }}" width="110" height="auto" alt="Learning Point Logo"--}}
                    {{--                         class="navbar-brand-image">--}}
                    <div class="mt-md-3 mt-0">
                        Learning Point
                    </div>
                </a>
            </h1>
            <div class="navbar-nav flex-row d-lg-none">

                <button class="nav-link px-0 hide-theme-dark" title="Switch light/dark mode"
                        id="dark-theme-btn-mobile"
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-moon-stars"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/>
                        <path d="M17 4a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2"/>
                        <path d="M19 11h2m-1 -1v2"/>
                    </svg>
                </button>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                              style="background-image: url('{{ asset('images/user.png') }}'); box-shadow: unset;"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->name }}</div>
                            <div class="mt-1 small text-muted">Admin User</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Status</a>
                        <a href="./profile.html" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Feedback</a>
                        <div class="dropdown-divider"></div>
                        <a href="./settings.html" class="dropdown-item">Settings</a>
                        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href="./">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <i class="ti ti-custom ti-home"></i>
                          </span>
                            <span class="nav-link-title">Home</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle show" href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-custom ti-box"></i>
                            </span>
                            <span class="nav-link-title">Modules</span>
                        </a>
                        <div class="dropdown-menu show">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item @if(request()->is('*/students*')) active @endif"
                                       href="{{ route('dashboard.students.index') }}">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-user-star"></i>
                                         </span>
                                        Students
                                    </a>
                                    <a class="dropdown-item @if(request()->is('*/subjects*')) active @endif"
                                       href="{{ route('dashboard.subjects.index') }}">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-book-2"></i>
                                         </span>
                                        Subjects
                                    </a>
                                    <a class="dropdown-item" href="#">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-chalkboard"></i>
                                         </span>
                                        Sessions
                                        <span class="badge badge-sm bg-warning-lt text-uppercase ms-auto">P</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle show" href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-custom ti-box"></i>
                            </span>
                            <span class="nav-link-title">Learning Point</span>
                        </a>
                        <div class="dropdown-menu show">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="#">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-users"></i>
                                         </span>
                                        Employees
                                        <span class="badge badge-sm bg-warning-lt text-uppercase ms-auto">P</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-adjustments-dollar"></i>
                                         </span>
                                        Expenses
                                        <span class="badge badge-sm bg-warning-lt text-uppercase ms-auto">P</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-chart-infographic"></i>
                                         </span>
                                        Reports
                                        <span class="badge badge-sm bg-warning-lt text-uppercase ms-auto">P</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle show" href="#navbar-base" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-custom ti-box"></i>
                            </span>
                            <span class="nav-link-title">System</span>
                        </a>
                        <div class="dropdown-menu show">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item @if(request()->is('*/users*')) active @endif"
                                       href="{{ route('dashboard.users.index') }}">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-users-group"></i>
                                         </span>
                                        Users
                                    </a>
                                </div>
                                <a class="dropdown-item @if(request()->is('*/groups*')) active @endif"
                                   href="{{ route('dashboard.groups.index') }}">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-book-2"></i>
                                         </span>
                                    Groups
                                </a>
                                <a class="dropdown-item @if(request()->is('*/schools*')) active @endif"
                                   href="{{ route('dashboard.schools.index') }}">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-list-letters"></i>
                                         </span>
                                    Schools
                                </a>
                                <a class="dropdown-item @if(request()->is('*/families*')) active @endif"
                                   href="{{ route('dashboard.families.index') }}">
                                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                                             <i class="ti ti-custom ti-friends"></i>
                                         </span>
                                    Families
                                </a>
                            </div>
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </aside>
    <!-- Navbar -->
    <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav flex-row order-md-last">
                <div class="d-none d-md-flex me-2">
                    <button class="nav-link px-0 hide-theme-dark" title="Switch light/dark mode"
                            id="dark-theme-btn"
                            data-bs-toggle="tooltip"
                            data-bs-placement="bottom">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-moon-stars"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/>
                            <path d="M17 4a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2"/>
                            <path d="M19 11h2m-1 -1v2"/>
                        </svg>
                        <!--</editor-fold>-->
                    </button>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                              style="background-color: unset; background-image: url('{{ asset('images/user.png') }}'); box-shadow: unset;"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->name }}</div>
                            <div class="mt-1 small text-muted">Admin User</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Status</a>
                        <a href="./profile.html" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Feedback</a>
                        <div class="dropdown-divider"></div>
                        <a href="./settings.html" class="dropdown-item">Settings</a>
                        <a href="./sign-in.html" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div>
                    {{--                    I wonder how they see me, ashes on wool.--}}
                </div>
            </div>
        </div>
    </header>
    <div class="page-wrapper">

        {{ $slot }}

        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row">

                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; {{ date('Y') }}
                                <a href="." class="link-secondary">{{ config('app.name') }}</a>.
                                All rights reserved.
                            </li>
                            <li class="list-inline-item">
                                <a href="https://github.com/ravensborn/learning-point" class="link-secondary"
                                   rel="noopener">
                                    v1.0.0
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>


    </div>
</div>

<!-- Tabler Core -->
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts/>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const themeSwitch = document.getElementById('dark-theme-btn');
        const themeSwitchMobile = document.getElementById('dark-theme-btn-mobile');

        themeSwitch.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });

        themeSwitchMobile.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    });
</script>

</body>
</html>
