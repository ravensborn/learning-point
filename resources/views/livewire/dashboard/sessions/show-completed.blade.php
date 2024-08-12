<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        View Session {{ $session->number }}
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

            <div class="row row-deck row-cards">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Session Details</h3>

                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Session</div>
                                    <div class="datagrid-content">{{ $session->number }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created By</div>
                                    <div class="datagrid-content">{{ $session->created_by ?? '-' }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Managed By</div>
                                    <div class="datagrid-content">{{ $session->user->name ?? '-' }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created At</div>
                                    <div
                                        class="datagrid-content">{{ $session->created_at->format('Y-m-d / H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Teacher</div>
                                    <div class="datagrid-content">{{ $session->teacher->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Subject</div>
                                    <div class="datagrid-content">{{ $session->subject->group->name }}
                                        / {{ $session->subject->name }}</div>
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
                                    <div class="datagrid-title">Time in</div>
                                    <div class="datagrid-content">{{ $session->time_in->format('Y-m-d / H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Time out</div>
                                    <div
                                        class="datagrid-content">{{ $session->time_out->format('Y-m-d / H:i') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Duration</div>
                                    <div
                                        class="datagrid-content">
                                        {{ $session->sessionDuration }}
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
                                    <div class="datagrid-title">Attended</div>
                                    <div class="datagrid-content">
                                        <span class="badge text-body">
                                            {{ $session->attendees->where('attending', true)->count() }} / {{ $session->attendees->count() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Total</div>
                                    <div class="datagrid-content">
                                        <span class="badge text-body">
                                            ${{ number_format($session->total, 2) }}
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
            </div>

            @forelse($session->attendees as $attendee)

                <div class="row row-deck row-cards mt-3">

                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="me-3">
                                            <h3 class="card-title">
                                                <a href="{{ route('dashboard.students.show', $attendee->student_id) }}"
                                                   target="_blank">{{ $attendee->student->full_name }}</a>
                                            </h3>
                                        </div>
                                        <div class="me-3">
                                            <label class="form-check form-switch mb-0">
                                                <input @if($attendee->attending) checked="" @endif
                                                class="form-check-input"
                                                       disabled
                                                       type="checkbox">
                                                <span class="form-check-label">Attended</span>
                                            </label>
                                        </div>
                                        <div class="me-3">
                                            <label class="form-check form-switch mb-0">
                                                <input class="form-check-input"
                                                       @if($attendee->charged) checked="" @endif
                                                       disabled
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
                                        Student will not be charged.
                                    </div>
                                @else

                                    @if($attendee->attending)

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                @forelse($attendee->charge_list as $index => $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $item['name'] }}
                                                            @if($item['managed'])
                                                                <span class="text-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-bolt" width="24"
                                                                 height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                 stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round"><path
                                                                    stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                                                    d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11"/></svg>
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
                                                    </tr>
                                                @empty
                                                    <tr>
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
                                                    <tr>
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
                                                    </tr>
                                                @empty
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
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                @endif


                            </div>
                        </div>
                    </div>

                </div>

            @empty
                <div class="row row-deck row-cards mt-3">
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
