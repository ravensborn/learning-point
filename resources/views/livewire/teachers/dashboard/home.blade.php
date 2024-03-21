<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Dashboard
                    </div>
                    <h2 class="page-title">
                        Overview
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <div class="col-12">
                    <div class="card card-md">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h3 class="h1">Welcome Back, {{ auth()->guard('teacher')->user()->name }}</h3>
                                    <div class="markdown text-secondary">
                                        Welcome to the LP System Control Panel, your central hub for session management.
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('teacher.dashboard.sessions.index') }}" class="btn btn-primary"
                                           rel="noopener">My Sessions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
