<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Session / {{ $session->number }} / Attendance Management
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            {{--            <div class="row row-deck row-cards">--}}
            {{--                <span class="text-warning">--}}
            {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor" /></svg>--}}
            {{--                    Updating will reset the charge list for students of this session.--}}
            {{--                </span>--}}
            {{--            </div>--}}
            <div class="row row-deck row-cards mt-3">

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Attendance</h3>
                        </div>
                        <div class="card-body">
                            @forelse($session->attendees as $attendee)
                                <div class="list-group list-group-flush list-group-hoverable border-bottom"
                                     wire:key="{{ $attendee->id }}">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span class="badge bg-info"></span></div>
                                            <div class="col text-truncate">
                                                <span
                                                    class="text-reset d-block @if(!$attendee->attending) text-secondary @endif">
                                                    {{ $attendee->student->full_name }}
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <label class="form-check form-switch mb-0">
                                                    <input wire:change="toggleStudentAttending({{ $attendee->id }})"
                                                           @if($attendee->attending) checked="" @endif
                                                           class="form-check-input"
                                                           type="checkbox">
                                                    <span class="form-check-label">Attending</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div>
                                    This session have no students assigned.
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>

            <div class="row row-deck row-cards mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{ route('teacher.dashboard.sessions.index') }}" class="btn btn-primary" style="width: 300px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 12l5 5l10 -10"/>
                            <path d="M2 12l5 5m5 -5l5 -5"/>
                        </svg>
                        Close
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>
