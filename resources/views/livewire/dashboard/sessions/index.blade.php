<div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Sessions
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('dashboard.sessions.advanced-search') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/>
                                <path d="M21 21l-6 -6"/>
                            </svg>
                            Advanced Search
                        </a>
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

            <div class="row row-cards"
                 wire:init="calculateStatistics">
                @foreach($statisticsCards as $card)
                    <div class="col-sm-6 col-lg-3">
                        <div
                            wire:click="selectStatus('{{ $card['filter_key'] }}')"
                            @class(['card card-sm' => true, 'border-primary' => $selectedStatus == $card['filter_key']])>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="{{ $card['class'] }} avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-chart-arrows-vertical" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M18 21v-14"/>
                                                <path d="M9 15l3 -3l3 3"/>
                                                <path d="M15 10l3 -3l3 3"/>
                                                <path d="M3 21l18 0"/>
                                                <path d="M12 21l0 -9"/>
                                                <path d="M3 6l3 -3l3 3"/>
                                                <path d="M6 21v-18"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            {{ $card['total'] . ' ' . $card['name'] }}
                                        </div>
                                        <div class="text-secondary">
                                            {{ $card['today'] . ' ' . 'Today' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row row-deck row-cards mt-3">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header w-100">
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                    <h3 class="card-title">Session List</h3>
                                </div>
                                <div>
                                    <label class="form-check form-switch mb-0">
                                        <input wire:change="toggleTodayFilter()"
                                               @if($showToday) checked="" @endif
                                               class="form-check-input"
                                               type="checkbox">
                                        <span class="form-check-label">Show Today</span>
                                    </label>
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
                                <div class="ms-auto text-secondary d-flex">
                                    <div class="me-2">
                                        Type:
                                        <div class="ms-2 d-inline-block">
                                            <select id="sessionType" wire:model.live="sessionType"
                                                    class="form-control form-control-sm"
                                                    aria-label="Session type">
                                                <option value="all">All</option>
                                                @foreach(\App\Models\Session::TYPES as $key => $name)
                                                    <option value="{{ $key }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="me-2">
                                        Search:
                                        <div class="ms-2 d-inline-block">
                                            <input wire:model.live="search" type="search"
                                                   class="form-control form-control-sm"
                                                   aria-label="Search items">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter datatable">
                                <thead>
                                <tr>
                                    <th class="w-1">
                                        No.
                                        <span class="cursor-pointer" wire:click="sortByColumn('id')">
                                            {!! $this->getHeaderSortIcon('id') !!}
                                        </span>
                                    </th>
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
                                            <div class="d-flex justify-content-end gap-1">
                                                <a class="btn align-text-top"
                                                   href=""
                                                   wire:click.prevent="openShowSessionDetailsModal({{ $session->id }})">
                                                    <!--<editor-fold desc="SVG ICON">-->
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-maximize"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /></svg>
                                                    <!--</editor-fold>-->
                                                    Peek
                                                </a>
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
                                                <span class="dropdown">
                                                  <button class="btn dropdown-toggle align-text-top"
                                                          data-bs-boundary="viewport"
                                                          data-bs-toggle="dropdown">Actions</button>
                                                  <div class="dropdown-menu dropdown-menu-end">
                                                      @foreach(\App\Models\Session::STATUSES as $key => $name)
                                                          @if($key == \App\Models\Session::STATUS_COMPLETED)
                                                              @continue
                                                          @endif
                                                          <button class="dropdown-item"
                                                                  wire:click="setStatus({{ $session->id }}, '{{ $key }}')">
                                                              {{ $name }}
                                                          </button>
                                                      @endforeach
                                                        <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item"
                                                            wire:click="prepareItemDeletion({{ $session->id }})">
                                                        Delete
                                                    </button>
                                                  </div>
                                            </span>

                                            </div>

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


    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" style="display: none;" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to remove this item? What you've done cannot be
                        undone.
                    </div>
                    @error('delete')
                    <div class="text-danger mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button class="btn w-100" wire:click="resetItemDeletion()">
                                    Cancel
                                </button>
                            </div>
                            <div class="col">
                                <a class="btn btn-danger w-100" data-bs-dismiss="modal"
                                   wire:click.prevent="startItemDeletion()">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-show-session" tabindex="-1" style="display: none;" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">

                    @if($this->peekSession)
                        <iframe height="700px" width="100%" src="{{ route('dashboard.sessions.show-completed', $this->peekSession->id) . '?peek-iframe=enabled' }}"></iframe>
                    @endif


                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-ghost-primary w-100" data-bs-dismiss="modal"
                                   wire:click.prevent="closeShowSessionModal()">
                                    Close
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {

            const deleteModal = new bootstrap.Modal('#modal-delete');
            const showSessionModal = new bootstrap.Modal('#modal-show-session');

            @this.
            on('close-all-modals', (event) => {
                deleteModal.hide();
            });

            @this.
            on('toggle-modal-delete-confirmation', (event) => {
                deleteModal.toggle();
            });

            @this.
            on('toggle-modal-show-session', (event) => {
                showSessionModal.toggle();
            });
        });
    </script>


</div>
