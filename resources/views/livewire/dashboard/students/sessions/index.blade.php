<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage {{ ucfirst($student->full_name) }} Sessions
                    </h2>
                </div>

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h3 class="card-title">Session List</h3>
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
                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input wire:model.live="search" type="search"
                                               class="form-control form-control-sm"
                                               aria-label="Search items">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>

                                    <th class="w-1">No.</th>
                                    <th>Series</th>
                                    <th>Teacher</th>
                                    <th>Subject</th>
                                    <th>Attended</th>
                                    <th>Date</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($sessions as $session)
                                    <tr wire:key="{{ $session->id }}">
                                        <td>
                                            <span class="text-secondary">
                                                {{ ($sessions->currentpage()-1) * $sessions->perpage() + $loop->index + 1 }}
                                            </span>
                                        </td>
                                        <td>{{ $session->number }}</td>
                                        <td>{{ ucfirst($session->teacher?->name ?? '-') }}</td>
                                        <td>{{ ucfirst($session->subject?->name ?? '-') }}</td>
                                        <td>
                                            {{ $session->attendees->where('student_id', $student->id)->where('attending', true)->count() ? 'Yes' : 'No' }}
                                        </td>
                                        <td style="width: 100px;" class="text-center">
                                            <div>
                                                <div>
                                                    {{ $session->time_in->format('d-M-y') }}
                                                </div>
                                            </div>

                                            <div>
                                                <div class="border border-success rounded mt-1">
                                                    {{ $session->time_in->format('H:i') }}
                                                </div>
                                                <div class="border border-warning rounded mt-1">
                                                    {{ $session->time_out->format('H:i') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $session->sessionDuration }}
                                        </td>
                                        <td>
                                            <span class="badge text-body {{ $session->status_color_class }}">
                                                {{ $session->status_name }}
                                            </span>
                                        </td>
                                        <td>{{ ucfirst($session->user->name ?? '-') }}</td>
                                        <td>{{ $session->created_at->format('Y-m-d / H:i') }}</td>

                                        <td class="text-end">
                                            <a class="btn align-text-top"
                                               href="{{ route('dashboard.sessions.manage', $session->id) }}">
                                                View
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
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
