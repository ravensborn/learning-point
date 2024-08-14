<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage {{ ucfirst($teacher->name) }} Sessions
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <div class="row row-deck row-cards mb-3">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stats</h3>
                        </div>
                        <div class="card-body border-bottom py-3">

                            <div class="row border-bottom py-3">
                                <div class="col-12">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               wire:change="toggleDateFiltering"
                                               @if($dateFiltering) checked="" @endif>
                                        <span class="form-check-label">Date Filtering</span>
                                    </label>
                                </div>
                                @if($dateFiltering)
                                    <div class="mt-5"></div>
                                    <div class="row">
                                        <div class="col-6 col-md-3">
                                            <label for="from_date" class="form-label required">Date Form</label>
                                            <input type="date" id="from_date" class="form-control"
                                                   wire:model.live="dateFrom">
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <label for="to_date" class="form-label required">Date To</label>
                                            <input type="date" id="to_date" class="form-control"
                                                   wire:model.live="dateTo">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row pt-3 g-3"
                                 wire:loading.remove
                                 wire:target="loadTeacherStats, dateFrom, dateTo">

                                <div class="col-3">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <span class="badge bg-success"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            Number of Sessions
                                            <div class="text-secondary text-truncate mt-n1">
                                                {{ $numberOfSessions }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <span class="badge bg-success"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            Total Hours
                                            <div class="text-secondary text-truncate mt-n1">
                                                {{ $numberOfHours }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:loading wire:target="loadTeacherStats, dateFrom, dateTo">
                                <div class="mt-3 spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="ms-2">
                                    Loading...
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Date</th>
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
                                        <td colspan="7" class="text-center">
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
