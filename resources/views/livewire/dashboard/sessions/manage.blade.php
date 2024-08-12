<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Session
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">

                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <div class="row row-deck row-cards">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Session Details</h3>
                            <div class="d-flex">
                                <div class="dropdown me-2">
                                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="{{ route('dashboard.sessions.edit', $session->id) }}">
                                            Edit Session
                                        </a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                           data-bs-target="#modal-add-student">
                                            Add New Student
                                        </a>
                                        <a class="dropdown-item" href="#" wire:click="showAddChargeModal('all')">
                                            Bulk Charge
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           wire:click="showAddChargeModal('all-cancellation')">
                                            Bulk Cancellation Charge
                                        </a>
                                        <a class="dropdown-item"
                                           href="{{ route('dashboard.sessions.tags', $session->id) }}">
                                            Manage Session Tags
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown me-2">
                                    <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Session</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"
                                           wire:click="setStatus('{{ \App\Models\Session::STATUS_PENDING }}')">
                                            Set as Pending
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           wire:click="setStatus('{{ \App\Models\Session::STATUS_PROCESSED }}')">
                                            Set as Processed
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           wire:click="setStatus('{{ \App\Models\Session::STATUS_REJECTED }}')">
                                            Set as Rejected
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           wire:click="setStatus('{{ \App\Models\Session::STATUS_CANCELLED }}')">
                                            Cancel Session
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" wire:click="completeSession()">
                                            Complete Session
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ route('dashboard.sessions.print', $this->session->id) }}" class="btn me-2">Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Session</div>
                                    <div class="datagrid-content">{{ $session->number }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Teacher</div>
                                    <div class="datagrid-content">{{ $session->teacher->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Group / Subject</div>
                                    <div class="datagrid-content">{{ $session->subject->group->name }}
                                        / {{ $session->subject->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Date</div>
                                    <div class="datagrid-content">{{ $session->time_in->format('d-M-y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">No. of Students</div>
                                    <div class="datagrid-content">
                                        <span class="badge text-body">
                                            {{ $session->attendees->where('attending', true)->count() }} / {{ $session->attendees->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Duration</div>
                                    <div
                                        class="datagrid-content">
                                        {{ $session->sessionDuration }}
                                    </div>
                                </div>

                                <div class="datagrid-item">
                                    <div class="datagrid-title">Total</div>
                                    <div class="datagrid-content">
                                        <span class="badge text-body">
                                            ${{ number_format($sessionTotal, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status</div>
                                    <div class="datagrid-content">
                                        <span class="badge text-white {{ $session->status_color_class }}">
                                            {{ $session->status_name }}
                                        </span>
                                    </div>
                                </div>

                                <div class="datagrid-item">
                                    <div class="datagrid-title">Time in</div>
                                    <div class="datagrid-content">{{ $session->time_in->format('H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Time out</div>
                                    <div
                                        class="datagrid-content">{{ $session->time_out->format('H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created By</div>
                                    <div class="datagrid-content">{{ $session->created_by ?? '-' }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created At</div>
                                    <div
                                        class="datagrid-content">{{ $session->created_at->format('Y-m-d / H:i') }}</div>
                                </div>

                                <div class="datagrid-item">
                                    <div class="datagrid-title">Tags</div>
                                    <div class="datagrid-content">
                                        @if($session->tags->count() > 0)
                                            @foreach($session->tags as $tag)
                                                <div class="badge text-body">
                                                    {{ $tag->name }}
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-muted">
                                                No tags
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="datagrid-item">
                                    <div class="datagrid-title">Cancellation Fee Limit</div>
                                    <div
                                        class="datagrid-content">
                                        ${{ number_format($this->settings->maximum_session_cancellation_charge_limit, 2) }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Type</div>
                                    <div class="datagrid-content">
                                        <span class="badge text-body">
                                            {{ $session->type_name }}
                                        </span>
                                    </div>
                                </div>

                                <div class="datagrid-item">
                                    <div class="datagrid-title">Approval Note</div>
                                    <div class="datagrid-content">
                                        {{ $session->approval_note }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Note</div>
                                    <div class="datagrid-content">
                                        {{ $session->note }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="col-3">--}}

                {{--                    <div class="card">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <h3 class="card-title">Session options</h3>--}}
                {{--                        </div>--}}
                {{--                        <div class="list-group list-group-flush">--}}
                {{--                            <a href="#"--}}
                {{--                               class="list-group-item list-group-item-action" aria-current="true">--}}
                {{--                                Complete Session--}}
                {{--                            </a>--}}
                {{--                            <a href="#" wire:click="showAddChargeModal('all')"--}}
                {{--                               class="list-group-item list-group-item-action" aria-current="true">--}}
                {{--                                Bulk Charge--}}
                {{--                            </a>--}}
                {{--                            <a href="#" wire:click="showAddChargeModal('all-cancellation')"--}}
                {{--                               class="list-group-item list-group-item-action" aria-current="true">--}}
                {{--                                Bulk Cancellation Charge--}}
                {{--                            </a>--}}
                {{--                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">--}}
                {{--                                Cancel Session--}}
                {{--                            </a>--}}
                {{--                            <a href="{{ route('dashboard.sessions.edit', $session->id) }}"--}}
                {{--                               class="list-group-item list-group-item-action" aria-current="true">--}}
                {{--                                Edit Session--}}
                {{--                            </a>--}}
                {{--                            <a href="#"--}}
                {{--                               data-bs-toggle="modal"--}}
                {{--                               data-bs-target="#modal-add-student"--}}
                {{--                               class="list-group-item list-group-item-action" aria-current="true">--}}
                {{--                                Add Student--}}
                {{--                            </a>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}

                {{--                </div>--}}
            </div>

            <div class="row row-deck row-cards mt-3" id="students">

                @forelse($session->attendees as $attendee)

                    <div class="col-12" wire:key="{{ $attendee->id }}">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="me-3">
                                            <h3 class="card-title">
                                                <a href="{{ route('dashboard.students.show', $attendee->student_id) }}"
                                                   target="_blank">{{ $attendee->student->full_name }}</a>
                                                <div class="text-muted">
                                                    {{ $attendee->student?->school?->name ?? '' }} @if($attendee->student->grade) - @endif {{ $attendee->student?->grade?->name ?? '' }}
                                                </div>
                                            </h3>
                                        </div>
                                        <div class="me-3">
                                            <label class="form-check form-switch mb-0">
                                                <input wire:change="toggleStudentAttending({{ $attendee->id }})"
                                                       @if($attendee->attending) checked="" @endif
                                                       class="form-check-input"
                                                       type="checkbox">
                                                <span class="form-check-label">Attending</span>
                                            </label>
                                        </div>
                                        <div class="me-3">
                                            <label class="form-check form-switch mb-0">
                                                <input class="form-check-input"
                                                       wire:change="toggleStudentCharged({{ $attendee->id }})"
                                                       @if($attendee->charged) checked="" @endif
                                                       type="checkbox">
                                                <span class="form-check-label">Charged</span>
                                            </label>
                                        </div>
                                        <div class="me-3 text-info">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-receipt-dollar" width="24"
                                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path
                                                    d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"/>
                                                <path
                                                    d="M14.8 8a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1"/>
                                                <path d="M12 6v10"/>
                                            </svg>
                                            ${{ number_format($this->calculateAttendeeChargeList($attendee->id), 2) }}
                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                    <div>
                                        {{--                                        {{ array_search(true, array_column($attendee->charge_list, 'managed')) }}--}}
                                        @if($attendee->attending && $attendee->charged)
                                            <a href="#" class="btn btn-sm btn-ghost-info"
                                               wire:click.prevent="updateAttendeeSessionCharge({{ $attendee->id }})">
                                                <!--<editor-fold desc="SVG ICON">-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-refresh" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"/>
                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"/>
                                                </svg>
                                                <!--</editor-fold>-->
                                                Reset System Charge
                                            </a>
                                        @endif
                                        @if($attendee->charged)
                                            <a href="#" class="btn btn-sm btn-ghost-primary"
                                               wire:click.prevent="showAddChargeModal({{ $attendee->id }})">
                                                <!--<editor-fold desc="SVG ICON">-->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                     height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 5l0 14"/>
                                                    <path d="M5 12l14 0"/>
                                                </svg>
                                                <!--</editor-fold>-->
                                                Add Charge
                                            </a>
                                        @endif
                                        <button class="btn btn-sm btn-ghost-danger"
                                                wire:click.prevent="removeStudent({{ $attendee->student_id }})">
                                            <!--<editor-fold desc="SVG ICON">-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0"/>
                                                <path d="M10 11l0 6"/>
                                                <path d="M14 11l0 6"/>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                            </svg>
                                            <!--</editor-fold>-->
                                            @if($removingStudentId == $attendee->student_id)
                                                Are you sure?
                                            @else
                                                Remove Student
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                @if(!$attendee->charged)
                                    <div class="text-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-info-circle" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                                            <path d="M12 9h.01"/>
                                            <path d="M11 12h1v4h1"/>
                                        </svg>
                                        @if($attendee->attending)
                                            Free Session
                                        @else
                                            Ghost Student
                                        @endif
                                    </div>

                                @else
                                    @if($attendee->attending)

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                @forelse($attendee->charge_list as $index => $item)
                                                    <tr wire:key="attendee_{{ $attendee->id }}_charge_list_{{ $index }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $item['name'] }}
                                                            @if($item['managed'])
                                                                <span class="text-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="icon icon-tabler icon-tabler-bolt"
                                                                     width="24"
                                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                     stroke="currentColor" fill="none"
                                                                     stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11"/>
                                                                </svg>
                                                            </span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item['rated'] ? 'Rated' : 'Unrated' }}</td>
                                                        @if($item['rated'])
                                                            <td>{{ '$' . number_format($item['amount'], 2) . ' x ' . $duration . ' = ' . '$' . number_format(($item['amount'] * $duration), 2)}}</td>
                                                        @else
                                                            <td>{{ '$' . number_format($item['amount'], 2) }}</td>
                                                        @endif
                                                        <td>{{ $item['note'] }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-ghost-warning"
                                                               wire:click.prevent="showEditChargeModal({{ $attendee->id }}, {{ $index }})">
                                                                <!--<editor-fold desc="SVG ICON">-->
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="icon icon-tabler icon-tabler-pencil"
                                                                     width="24"
                                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                     stroke="currentColor" fill="none"
                                                                     stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path
                                                                        d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"/>
                                                                    <path d="M13.5 6.5l4 4"/>
                                                                </svg>
                                                                <!--</editor-fold>-->
                                                                Edit Charge
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-ghost-danger"
                                                               wire:click.prevent="removeCharge({{ $attendee->id }}, {{ $index }})">
                                                                <!--<editor-fold desc="SVG ICON">-->
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="icon icon-tabler icon-tabler-trash"
                                                                     width="24"
                                                                     height="24"
                                                                     viewBox="0 0 24 24" stroke-width="2"
                                                                     stroke="currentColor" fill="none"
                                                                     stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path d="M4 7l16 0"/>
                                                                    <path d="M10 11l0 6"/>
                                                                    <path d="M14 11l0 6"/>
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                                </svg>
                                                                <!--</editor-fold>-->
                                                                @if($index == $removingChargeListIndex && $attendee->id == $removingChargeListAttendeeId)
                                                                    Are you sure?
                                                                @else
                                                                    Remove Charge
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr wire:key="attendee_{{ $attendee->id }}_charge_list_zero">
                                                        <td colspan="5">
                                                        <span class="text-info">
                                                             <svg xmlns="http://www.w3.org/2000/svg"
                                                                  class="icon icon-tabler icon-tabler-info-circle"
                                                                  width="24" height="24"
                                                                  viewBox="0 0 24 24" stroke-width="2"
                                                                  stroke="currentColor" fill="none"
                                                                  stroke-linecap="round" stroke-linejoin="round">
                                                                 <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                 <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                                                                 <path d="M12 9h.01"/>
                                                                 <path d="M11 12h1v4h1"/>
                                                             </svg>
                                                             Student does not have any charges.
                                                        </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                @forelse($attendee->cancellation_charge_list as $index => $item)
                                                    <tr wire:key="attendee_{{ $attendee->id }}_cancel_charge_list_{{ $index }}">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['rated'] ? 'Rated' : 'Unrated' }}</td>

                                                        <td>
                                                            @if($item['amount'] > $this->settings->maximum_session_cancellation_charge_limit)
                                                                <span class="text-danger"
                                                                      title="Amount exceeds limit.">
                                                                           <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-alert-triangle"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                                stroke="currentColor" fill="none"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"><path
                                                                                   stroke="none" d="M0 0h24v24H0z"
                                                                                   fill="none"/><path d="M12 9v4"/><path
                                                                                   d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"/><path
                                                                                   d="M12 16h.01"/></svg>
                                                                        </span>
                                                            @endif
                                                            @if($item['rated'])
                                                                {{ '$' . number_format($item['amount'], 2) . ' x ' . $duration . ' = ' . '$' . number_format(($item['amount'] * $duration), 2)}}

                                                            @else
                                                                {{ '$' . number_format($item['amount'], 2) }}
                                                            @endif
                                                        </td>

                                                        <td>{{ $item['note'] }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-ghost-warning"
                                                               wire:click.prevent="showEditChargeModal({{ $attendee->id }}, {{ $index }})">
                                                                <!--<editor-fold desc="SVG ICON">-->
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="icon icon-tabler icon-tabler-pencil"
                                                                     width="24"
                                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                     stroke="currentColor" fill="none"
                                                                     stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path
                                                                        d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"/>
                                                                    <path d="M13.5 6.5l4 4"/>
                                                                </svg>
                                                                <!--</editor-fold>-->
                                                                Edit Charge
                                                            </a>
                                                            <a href="#" class="btn btn-sm btn-ghost-danger"
                                                               wire:click.prevent="removeCharge({{ $attendee->id }}, {{ $index }})">
                                                                <!--<editor-fold desc="SVG ICON">-->
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="icon icon-tabler icon-tabler-trash"
                                                                     width="24"
                                                                     height="24"
                                                                     viewBox="0 0 24 24" stroke-width="2"
                                                                     stroke="currentColor" fill="none"
                                                                     stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                    <path d="M4 7l16 0"/>
                                                                    <path d="M10 11l0 6"/>
                                                                    <path d="M14 11l0 6"/>
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                                </svg>
                                                                <!--</editor-fold>-->
                                                                @if($index == $removingChargeListIndex && $attendee->id == $removingChargeListAttendeeId)
                                                                    Are you sure?
                                                                @else
                                                                    Remove Charge
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr wire:key="attendee_{{ $attendee->id }}_cancel_charge_list_zero">
                                                        <td colspan="5">
                                                        <span class="text-info">
                                                             <svg xmlns="http://www.w3.org/2000/svg"
                                                                  class="icon icon-tabler icon-tabler-info-circle"
                                                                  width="24" height="24"
                                                                  viewBox="0 0 24 24" stroke-width="2"
                                                                  stroke="currentColor" fill="none"
                                                                  stroke-linecap="round" stroke-linejoin="round">
                                                                 <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                 <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                                                                 <path d="M12 9h.01"/>
                                                                 <path d="M11 12h1v4h1"/>
                                                             </svg>
                                                             Student does not have any cancellation charges.
                                                        </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                @endif


                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12" wire:key="0">
                        <div class="card">
                            <div class="card-body text-center">
                                No students are in this session.
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-add-student" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-add-student-form" wire:submit="addStudent">
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="search_student" class="form-label">Search</label>
                                    <input type="text" wire:model.live="searchStudentQuery" class="form-control"
                                           id="search_student"
                                           placeholder="Search by name, email, or phone number.">
                                    @error('form.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="d-flex flex-column gap-2 mt-3 justify-center">
                                        @forelse($foundStudents as $index => $student)
                                            @if(in_array($student->id, $selectedStudentIds))
                                                <div class="badge cursor-pointer border-success"
                                                     wire:click="removeSelectedStudent({{ $student->id }})">
                                                    {{ $student->full_name }}
                                                </div>
                                            @else
                                                <div class="badge cursor-pointer"
                                                     wire:click="selectStudent({{ $student->id }})">
                                                    {{ $student->full_name }}
                                                </div>
                                            @endif
                                        @empty
                                            <div class="text-secondary">
                                                No students to show, please adjust your search query.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-add-student-form"
                            wire:loading.attr="disabled" wire:target="addStudent">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Add
                        <span wire:loading wire:target="addStudent">
                            &nbsp; - Adding...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-add-charge" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $chargeModalTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-add-charge-form" wire:submit="addCharge">
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeName" class="form-label">Name</label>
                                    <input type="text" wire:model="attendeeChargeName"
                                           class="form-control"
                                           id="attendeeChargeName"
                                           placeholder="AB Charge">
                                    @error('attendeeChargeName')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeAmount" class="form-label">Amount (&dollar;)</label>
                                    <input type="text" wire:model="attendeeChargeAmount"
                                           class="form-control"
                                           id="attendeeChargeAmount"
                                           placeholder="100">
                                    @error('attendeeChargeAmount')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeType" class="form-label">Type</label>
                                    <select id="attendeeChargeType"
                                            wire:model.change="attendeeChargeType"
                                            class="form-control">
                                        <option value="rated">Rated</option>
                                        <option value="unrated">Unrated</option>
                                    </select>

                                    @error('attendeeChargeType')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeNote" class="form-label">Note</label>
                                    <input type="text" wire:model="attendeeChargeNote"
                                           class="form-control"
                                           id="attendeeChargeNote"
                                           placeholder="Write charge description">
                                    @error('attendeeChargeNote')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-add-charge-form"
                            wire:loading.attr="disabled" wire:target="addCharge">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Add
                        <span wire:loading wire:target="addCharge">
                            &nbsp; - Adding...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-edit-charge" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Charge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-edit-charge-form" wire:submit="updateCharge">
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeName" class="form-label">Name</label>
                                    <input type="text" wire:model="attendeeChargeName"
                                           class="form-control"
                                           id="attendeeChargeName"
                                           placeholder="AB Charge">
                                    @error('attendeeChargeName')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeAmount" class="form-label">Amount (&dollar;)</label>
                                    <input type="text" wire:model="attendeeChargeAmount"
                                           class="form-control"
                                           id="attendeeChargeAmount"
                                           placeholder="100">
                                    @error('attendeeChargeAmount')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeType" class="form-label">Type</label>
                                    <select id="attendeeChargeType"
                                            wire:model.change="attendeeChargeType"
                                            class="form-control">
                                        <option value="rated">Rated</option>
                                        <option value="unrated">Unrated</option>
                                    </select>

                                    @error('attendeeChargeType')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="attendeeChargeNote" class="form-label">Note</label>
                                    <input type="text" wire:model="attendeeChargeNote"
                                           class="form-control"
                                           id="attendeeChargeNote"
                                           placeholder="Write charge description">
                                    @error('attendeeChargeNote')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-edit-charge-form"
                            wire:loading.attr="disabled" wire:target="updateCharge">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Add
                        <span wire:loading wire:target="updateCharge">
                            &nbsp; - Adding...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:initialized', () => {


            document.getElementById('modal-add-student').addEventListener('hidden.bs.modal', event => {
                @this.
                resetAddStudentForm();
            });

            document.getElementById('modal-add-charge').addEventListener('hidden.bs.modal', event => {
                @this.
                resetChargeStudentForm();
            });

            document.getElementById('modal-edit-charge').addEventListener('hidden.bs.modal', event => {
                @this.
                resetChargeStudentForm();
            });

            const addStudentModal = new bootstrap.Modal('#modal-add-student');
            const addChargeModal = new bootstrap.Modal('#modal-add-charge');
            const editChargeModal = new bootstrap.Modal('#modal-edit-charge');

            @this.
            on('close-all-modals', (event) => {
                addStudentModal.hide();
                addChargeModal.hide();
                editChargeModal.hide();
            });

            @this.
            on('toggle-modal-add-student', (event) => {
                addStudentModal.toggle();

            });

            @this.
            on('toggle-modal-edit-charge', (event) => {
                editChargeModal.toggle();
            });

            @this.
            on('toggle-modal-charge-student', (event) => {
                addChargeModal.toggle();
            });

        });
    </script>

</div>
