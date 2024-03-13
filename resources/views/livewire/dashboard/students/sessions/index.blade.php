<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage {{ ucfirst($student->full_name) }} Sessions
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('dashboard.sessions.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            New Session
                        </a>
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
                                            <span class="badge text-white {{ $session->status_color_class }}">
                                                {{ $session->status_name }}
                                            </span>
                                        </td>
                                        <td>{{ ucfirst($session->user->name) }}</td>
                                        <td>{{ $session->created_at->format('Y-m-d / h:i A') }}</td>

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
