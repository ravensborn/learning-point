<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Students
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('dashboard.students.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            New Student
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
                            <h3 class="card-title">Student List</h3>
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

                        @if($this->isMultiSelectMode())
                            <div class="card-body border-bottom border-top-0 py-3">


                                <div class="d-flex flex-row justify-content-start ">
                                    <div class="me-1">
                                        {{ $this->getNumberOfSelectedStudents('with-text')  }} -
                                    </div>
                                    <div>
                                            <span class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-link align-text-top"
                                                   data-bs-boundary="viewport"
                                                   data-bs-toggle="dropdown">
                                                    Bulk Actions
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <button class="dropdown-item"
                                                            wire:click="startBulkItemDeletion()">
                                                        Delete
                                                    </button>
                                                    <button class="dropdown-item"
                                                            wire:click="bulkActions('clear')">
                                                        Clear
                                                    </button>
                                                </div>
                                            </span>
                                    </div>

                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>

                                    <th class="w-1"></th>
                                    <th class="w-1">No.</th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Wallet
                                    </th>
                                    <th>
                                        Linked Wallet
                                    </th>
                                    <th>
                                        Joined
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($students as $student)
                                    <tr wire:key="{{ $student->id }}">
                                        <td>
                                            <input class="form-check-input m-0 align-middle"
                                                   value="{{ $student->id }}"
                                                   wire:model.live="selectedStudents"
                                                   type="checkbox"
                                                   aria-label="Select student">
                                        </td>
                                        <td>
                                            <span class="text-secondary">
                                                {{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <span class="avatar me-2" style="background-origin: content-box; padding: 5px; background-image: url('{{ $student->avatar_url }}')"></span>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{ $student->full_name }}</div>
                                                    <div class="text-secondary">
                                                        {{ $student?->school?->name }} / {{ $student?->school?->grade }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($student->wallet, 2) }}</td>
                                        <td>$0</td>
                                        <td>{{ $student->created_at->format('Y-m-d') }}</td>
                                        <td class="text-end">
                                            <a class="btn align-text-top"
                                               href="{{ route('dashboard.students.show', ['student' => $student->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-user" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                                </svg>
                                                Profile
                                            </a>
                                            <a class="btn align-text-top"
                                               href="{{ route('dashboard.students.show', ['student' => $student->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-arrows-down-up" width="24"
                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M17 3l0 18"/>
                                                    <path d="M10 18l-3 3l-3 -3"/>
                                                    <path d="M7 21l0 -18"/>
                                                    <path d="M20 6l-3 -3l-3 3"/>
                                                </svg>
                                                Transactions
                                            </a>
                                            <span class="dropdown">
                                                  <button class="btn dropdown-toggle align-text-top"
                                                          data-bs-boundary="viewport"
                                                          data-bs-toggle="dropdown">
                                                      Actions
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-end">
                                                    <button class="dropdown-item"
                                                            wire:click="prepareItemDeletion({{ $student->id }})">
                                                        Delete
                                                    </button>
                                                  </div>
                                                </span>
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
                                <span>{{  $students->firstItem()  }}</span>
                                to
                                <span>{{ $students->lastItem() }}</span>
                                of
                                <span> {{ $students->total() }}</span>
                                entries
                            </p>
                            <div class="m-0 ms-auto">
                                {{ $students->links() }}
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

    <div class="modal modal-blur fade" id="modal-bulk-action-delete" tabindex="-1" style="display: none;"
         aria-hidden="true"
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
                    <div class="text-secondary">Do you really want to remove selected items? What you are about to do
                        cannot be
                        undone.
                    </div>
                    @error('bulk-action-delete')
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
                                   wire:click.prevent="bulkActions('delete')">
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
            const bulkActionDeleteModal = new bootstrap.Modal('#modal-bulk-action-delete');

            @this.
            on('close-all-modals', (event) => {
                deleteModal.hide();
                bulkActionDeleteModal.hide();
            });

            @this.
            on('toggle-modal-bulk-action-delete-confirmation', (event) => {
                bulkActionDeleteModal.toggle();
            });

            @this.
            on('toggle-modal-delete-confirmation', (event) => {
                deleteModal.toggle();
            });

        });
    </script>


</div>
