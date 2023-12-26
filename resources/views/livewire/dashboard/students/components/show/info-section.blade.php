<div class="col-lg-4">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="card-title">Basic info</div>
                        <div class="link-secondary cursor-pointer"
                             wire:click.prevent="showStudentEditModal()">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                <path
                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                <path d="M16 5l3 3"/>
                            </svg>
                            <!--</editor-fold>-->
                        </div>
                    </div>
                    <div class="mb-2">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon me-2 text-secondary" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path
                                d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"/>
                            <path d="M3 7l9 6l9 -6"/>
                        </svg>
                        <!--</editor-fold>-->
                        E-Mail:
                        <strong>
                            <a href="{{ $student->email }}">{{ $student->email }}</a>
                        </strong>
                    </div>
                    <div class="mb-2">
                        @if($student->isFemale())
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24"
                                 height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"/>
                                <path d="M12 14v7"/>
                                <path d="M9 18h6"/>
                            </svg>
                            <!--</editor-fold>-->
                        @else
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"/>
                                <path d="M19 5l-5.4 5.4"/>
                                <path d="M19 5h-5"/>
                                <path d="M19 5v5"/>
                            </svg>
                            <!--</editor-fold>-->
                        @endif
                        Gender: <strong>{{ ucwords($student->gender) }}</strong>
                    </div>
                    <div class="mb-2">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary"
                             width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 20h18v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8z"></path>
                            <path
                                d="M3 14.803c.312 .135 .654 .204 1 .197a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1c.35 .007 .692 -.062 1 -.197"></path>
                            <path d="M12 4l1.465 1.638a2 2 0 1 1 -3.015 .099l1.55 -1.737z"></path>
                        </svg>
                        <!--</editor-fold>-->
                        Birth date: <strong>{{ $student->birthday?->format('Y-m-d') }}</strong>
                    </div>
                    <div class="mb-2">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon me-2 text-secondary" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path
                                d="M13 3a1 1 0 0 1 1 1v4.535l3.928 -2.267a1 1 0 0 1 1.366 .366l1 1.732a1 1 0 0 1 -.366 1.366l-3.927 2.268l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1 -1.366 .366l-3.928 -2.269v4.536a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-4.536l-3.928 2.268a1 1 0 0 1 -1.366 -.366l-1 -1.732a1 1 0 0 1 .366 -1.366l3.927 -2.268l-3.927 -2.268a1 1 0 0 1 -.366 -1.366l1 -1.732a1 1 0 0 1 1.366 -.366l3.928 2.267v-4.535a1 1 0 0 1 1 -1h2z"/>
                        </svg>
                        <!--</editor-fold>-->
                        Blood type: <strong>{{ $student->blood_type }}</strong>
                    </div>
                    <div class="mb-2 text-truncate" title="{{ $student->full_address }}">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            <path
                                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                        </svg>
                        <!--</editor-fold>-->
                        Lives in: <strong> {{ $student->full_address }}</strong>
                    </div>
                    <div class="mb-2">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon me-2 text-secondary" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path
                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"/>
                            <path d="M16 3l0 4"/>
                            <path d="M8 3l0 4"/>
                            <path d="M4 11l16 0"/>
                            <path d="M8 15h2v2h-2z"/>
                        </svg>
                        <!--</editor-fold>-->
                        Joined: <strong> {{ $student->created_at->format('Y-m-d') }}</strong>
                    </div>
                    <div class="mb-2">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h2"/>
                            <path
                                d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                        </svg>
                        <!--</editor-fold>-->
                        Created by: <strong> {{ ucfirst($student->user->name) }}</strong>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h2 class="card-title">School information</h2>
                        <div class="link-secondary cursor-pointer"
                             wire:click.prevent="showSchoolEditModal()">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                <path
                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                <path d="M16 5l3 3"/>
                            </svg>
                            <!--</editor-fold>-->
                        </div>
                    </div>

                    @if($student->school)
                        <div class="mb-2">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                            </svg>
                            <!--</editor-fold>-->
                            Name: <strong>{{ ucfirst($student->school->name) }}</strong>
                        </div>
                        <div class="mb-2">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M17.8 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"/>
                                <path
                                    d="M6.2 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"/>
                                <path
                                    d="M12 9.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"/>
                            </svg>
                            <!--</editor-fold>-->
                            Grade: <strong>{{ ucfirst($student->grade?->name ?? null) }}</strong>
                        </div>
                        <div class="mb-2">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 6l7 7l-4 4"/>
                                <path
                                    d="M5.828 18.172a2.828 2.828 0 0 0 4 0l10.586 -10.586a2 2 0 0 0 0 -2.829l-1.171 -1.171a2 2 0 0 0 -2.829 0l-10.586 10.586a2.828 2.828 0 0 0 0 4z"/>
                                <path d="M4 20l1.768 -1.768"/>
                            </svg>
                            <!--</editor-fold>-->
                            Academic stream:
                            <strong>{{ $student->academic_stream_name }}</strong>
                        </div>
                        <div class="mb-2">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"/>
                                <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"/>
                            </svg>
                            <!--</editor-fold>-->
                            Website:
                            <span>
                                <a target="_blank" href="{{ $student->school->url }}">
                                    Visit Site
                                    <!--<editor-fold desc="SVG ICON">-->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path
                                            d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"/>
                                        <path d="M11 13l9 -9"/>
                                        <path d="M15 4h5v5"/>
                                    </svg>
                                    <!--</editor-fold>-->
                                </a>
                            </span>
                        </div>
                        <div class="mb-2">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"/>
                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/>
                                <path d="M8 11v-4a4 4 0 1 1 8 0v4"/>
                            </svg>
                            <!--</editor-fold>-->
                            Username: <strong>{{ $student->school_username }}</strong>
                        </div>
                        <div class="mb-2">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon me-2 text-secondary" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"/>
                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/>
                                <path d="M8 11v-4a4 4 0 1 1 8 0v4"/>
                            </svg>
                            <!--</editor-fold>-->
                            Password:
                            <span>
                                @if($showStudentSchoolAccountPassword)
                                    <span class="fst-italic">{{ $student->school_password }}</span>
                                @else
                                    <span>******</span>
                                    <a href="#"
                                       wire:click.prevent="toggleStudentSchoolAccountPassword()">
                                        <!--<editor-fold desc="SVG ICON">-->
                                                   <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-lock-off" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"
                                                                                      fill="none"/><path
                                                           d="M15 11h2a2 2 0 0 1 2 2v2m0 4a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h4"/><path
                                                           d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/><path
                                                           d="M8 11v-3m.719 -3.289a4 4 0 0 1 7.281 2.289v4"/><path
                                                           d="M3 3l18 18"/></svg>
                                        <!--</editor-fold>-->
                                    </a>
                                @endif
                            </span>
                        </div>
                    @else
                        Student doesn't have school information, please click <a
                            wire:click.prevent="showSchoolEditModal()" href="#">here</a> to add.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
