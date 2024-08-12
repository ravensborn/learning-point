<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Your Sessions
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('teacher.dashboard.sessions.create') }}" class="btn btn-primary">
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
                            <table class="table card-table table-vcenter datatable">
                                <thead>
                                <tr>

                                    <th class="w-1">No.</th>
                                    <th>Subject</th>
                                    <th>Attendees</th>
                                    <th>Students</th>
                                    <th>Date</th>
                                    <th>Duration</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($sessions as $session)
                                    <tr wire:key="{{ $session->id }}">

                                        <td>
                                            <span
                                                class="text-secondary">
                                                {{ ($sessions->currentpage()-1) * $sessions->perpage() + $loop->index + 1 }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ ucfirst($session->subject?->name ?? '-') }}
                                        </td>
                                        <td>
                                            {{ $session->attendees->where('attending', true)->count() . '/' . $session->attendees->count() }}
                                        </td>
                                        <td>
                                            @foreach($session->attendees as $attendee)
                                                <div class="border border-azure rounded p-1 mb-1">
                                                    {{ $attendee->student->full_name }}
                                                </div>
                                            @endforeach
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
                                            {{ $session->sessionDuration  }}
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
                                        <td>
                                            @if($session->approval_note)
                                                <div x-data="{ show: false }">
                                                    <div class="cursor-pointer text-primary" x-show="!show" @click="show = ! show">Show Note</div>
                                                    <div x-show="show">
                                                        {{ $session->approval_note }}
                                                        <div class="cursor-pointer text-primary" @click="show = ! show">Hide Note</div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $session->created_at->format('Y-m-d') }}
                                        </td>

                                        <td class="text-end">
                                            {{--                                            @if($session->status != \App\Models\Session::STATUS_COMPLETED)--}}
                                            {{--                                                <a class="btn align-text-top"--}}
                                            {{--                                                   href="{{ route('teacher.dashboard.sessions.attendance', ['session' => $session->id]) }}">--}}
                                            {{--                                                    <!--<editor-fold desc="SVG ICON">-->--}}
                                            {{--                                                    <svg xmlns="http://www.w3.org/2000/svg"--}}
                                            {{--                                                         class="icon icon-tabler icon-tabler-notebook" width="24"--}}
                                            {{--                                                         height="24" viewBox="0 0 24 24" stroke-width="2"--}}
                                            {{--                                                         stroke="currentColor" fill="none" stroke-linecap="round"--}}
                                            {{--                                                         stroke-linejoin="round">--}}
                                            {{--                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>--}}
                                            {{--                                                        <path--}}
                                            {{--                                                            d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"/>--}}
                                            {{--                                                        <path d="M13 8l2 0"/>--}}
                                            {{--                                                        <path d="M13 12l2 0"/>--}}
                                            {{--                                                    </svg>--}}
                                            {{--                                                    <!--</editor-fold>-->--}}
                                            {{--                                                    Manage Attendance--}}
                                            {{--                                                </a>--}}
                                            {{--                                            @endif--}}
                                            @if($session->status == \App\Models\Session::STATUS_REJECTED)
                                                <a class="btn align-text-top"
                                                   href="{{ route('teacher.dashboard.sessions.edit', ['session' => $session->id]) }}">
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
                                                    Edit
                                                </a>
                                            @else
                                                <button class="btn align-text-top" disabled>
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
                                                    Edit
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
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

    <script>
        document.addEventListener('livewire:initialized', () => {

            const deleteModal = new bootstrap.Modal('#modal-delete');

            @this.
            on('close-all-modals', (event) => {
                deleteModal.hide();
            });

            @this.
            on('toggle-modal-delete-confirmation', (event) => {
                deleteModal.toggle();
            });
        });
    </script>


</div>
