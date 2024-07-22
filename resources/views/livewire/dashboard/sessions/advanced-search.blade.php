<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Advanced Search
                    </h2>
                </div>

                <div class="col-auto ms-auto">

                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <div class="row row-cards">

                <div class="col-12 col-md-4">
                    <label class="form-label" for="sessionNumber">Session Number</label>
                    <input type="text" class="form-control" placeholder="Session Number" id="sessionNumber"
                           wire:model.live="sessionNumber">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="teacher">Teacher</label>
                    <input type="text" class="form-control" placeholder="Teacher Name or E-Mail" id="teacher"
                           wire:model.live="teacher">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="family">Family</label>
                    <input type="text" class="form-control" placeholder="Family Name" id="family"
                           wire:model.live="family">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="student">Student</label>
                    <input type="text" class="form-control" placeholder="Student Name, E-Mail, or Phone Number" id="student"
                           wire:model.live="student">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="subjectId">Subject</label>
                    <select id="subjectId" class="form-control" wire:model.live="subjectId">
                        <option value="">All</option>
                        @foreach($availableSubjects as $indexGroup => $subjectGroup)
                            <optgroup label="{{ $subjectGroup->name }}"
                                      wire:key="subject-group-{{ $indexGroup }}">
                                @foreach($subjectGroup->subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                            wire:key="subject-{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="group">Group</label>
                    <input type="text" class="form-control" placeholder="Group Name" id="group" wire:model.live="group">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="sessionDate">Session Date</label>
                    <input type="date" class="form-control" placeholder="SessionDate" id="sessionDate"
                           wire:model.live="sessionDate">
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="sessionStatus">Session Status</label>
                    <select id="status" wire:model.live="sessionStatus" class="form-control">
                        <option value="all">All</option>
                        @foreach(\App\Models\Session::STATUSES as $key => $name)
                            <option value="{{ $key }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="sessionType">Session Type</label>
                    <select id="sessionType" wire:model.live="sessionType" class="form-control">
                        <option value="all">All</option>
                        @foreach(\App\Models\Session::TYPES as $key => $name)
                            <option value="{{ $key }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row row-deck row-cards mt-3">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header w-100">
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                    <h3 class="card-title">Session List</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <select wire:model.live="perPage" class="form-control form-control-sm"
                                                aria-label="Items per page">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    entries
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Teacher</th>
                                    <th>Group / Subject</th>
                                    <th>Date</th>
                                    <th>Students</th>
                                    <th>Duration</th>
                                    <th>Total</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($sessions as $session)
                                    <tr wire:key="{{ $session->id }}">

                                        <td>
                                            <span
                                                class="text-secondary">{{ ($sessions->currentpage()-1) * $sessions->perpage() + $loop->index + 1 }}</span>
                                        </td>
                                        <td>
                                            {{ ucfirst($session->teacher?->name ?? '-') }}
                                        </td>
                                        <td>
                                            {{ ucfirst($session->subject?->group?->name ?? '-') }}
                                            /
                                            {{ ucfirst($session->subject?->name ?? '-') }}
                                        </td>
                                        <td>
                                            <div>
                                                {{ $session->time_in->format('d-M-y / h:i A') }}
                                            </div>
                                            <div>
                                                {{ $session->time_out->format('d-M-y / h:i A') }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ $session->attendees->where('attending', true)->count() . '/' . $session->attendees->count() }}
                                        </td>
                                        <td>
                                            {{ $session->sessionDuration  }}
                                        </td>
                                        <td>
                                            @if($session->status == \App\Models\Session::STATUS_COMPLETED)
                                                ${{ number_format($session->total, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge text-body @if($session->type == \App\Models\Session::TYPE_THEORETICAL) border-pink @else border-primary  @endif">
                                                {{ $session->type_name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge text-body {{ $session->status_color_class }}">
                                                {{ $session->status_name }}
                                            </span>
                                        </td>

                                        <td class="text-end">
                                            <a class="btn align-text-top"
                                               href="{{ route('dashboard.sessions.manage', ['session' => $session->id]) }}">
                                                <!--<editor-fold desc="SVG ICON">-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-notebook" width="24"
                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/>
                                                    <path d="M13 8l2 0"/>
                                                    <path d="M13 12l2 0"/>
                                                </svg>
                                                <!--</editor-fold>-->
                                                Manage
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            There are no items at the moment.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-secondary">
                                Showing
                                <span>{{  $sessions->firstItem()  }}</span>
                                to
                                <span>{{ $sessions->lastItem() }}</span>
                                of
                                <span> {{ $sessions->total() }}</span>
                                entries
                            </p>
                            <div class="m-0 ms-auto">
                                {{ $sessions->links() }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
