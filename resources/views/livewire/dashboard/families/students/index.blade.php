<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage&nbsp;<a href="{{ route('dashboard.families.index') }}">{{ $family->number }}
                            / {{ ucfirst($family->name) }}</a>&nbsp;Members
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#modal-create">
                            <!--<editor-fold desc="SVG ICON">-->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            <!--</editor-fold>-->
                            New Member
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
                            <h3 class="card-title">Family Member List</h3>
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
                                    <th>
                                        Name
                                    </th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($students as $student)
                                    <tr wire:key="{{ $student->id }}">

                                        <td>
                                            <span class="text-secondary">
                                                {{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.students.show', $student->id) }}">{{ $student->full_name }}</a>
                                        </td>
                                        <td>
                                            {{ $student->created_at->format('Y-m-d') }}
                                        </td>

                                        <td class="text-end">
                                                <span class="dropdown">
                                                  <button class="btn dropdown-toggle align-text-top"
                                                          data-bs-boundary="viewport"
                                                          data-bs-toggle="dropdown">
                                                      Actions
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-end">
                                                    <button class="dropdown-item"
                                                            wire:click="prepareItemDeletion({{ $student->id }})">Delete</button>
                                                  </div>
                                                </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
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


    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-create-form" wire:submit="store">
                        <div class="row mb-3">
                            <div class="col-12 col-md-12 mb-3 mb-md-0">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" wire:model.live="memberSearchQuery" class="form-control"
                                           id="name"
                                           placeholder="Search student name">
                                    @error('form.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mt-3 d-flex flex-column gap-2 justify-content-start text-start">

                                    @forelse($searchedMemberList as $student)

                                        @if(in_array($student->id, $selectedMemberIds))
                                            <div class="badge border-success"
                                                 wire:click.prevent="selectSearchedMember({{ $student->id }})">
                                                <!--<editor-fold desc="SVG ICON">-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M5 12l5 5l10 -10"/>
                                                </svg>
                                                <!--</editor-fold>-->
                                                {{ $student->full_name }} - {{ $student->primary_phone_number }}
                                            </div>
                                        @else
                                            <div class="badge"
                                                 wire:click.prevent="selectSearchedMember({{ $student->id }})">
                                                {{ $student->full_name }} - {{ $student->primary_phone_number }}
                                            </div>
                                        @endif
                                    @empty
                                        <div class="text-secondary">
                                            No members to show, please adjust your search query.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-create-form"
                            wire:loading.attr="disabled" wire:target="store">

                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        <!--</editor-fold>-->
                        Save
                        <span wire:loading wire:target="store">
                            &nbsp; - Saving...
                        </span>
                    </button>
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
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <!--</editor-fold>-->
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
                                <a class="btn btn-danger w-100"
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


            document.getElementById('modal-create').addEventListener('hidden.bs.modal', event => {
                @this.
                resetForm();
            })

            const createModal = new bootstrap.Modal('#modal-create');
            const deleteModal = new bootstrap.Modal('#modal-delete');

            @this.
            on('close-all-modals', (event) => {
                createModal.hide();
                deleteModal.hide();
            });

            @this.
            on('toggle-modal-delete-confirmation', (event) => {
                deleteModal.toggle();
            });

            @this.
            on('toggle-modal-create', (event) => {
                createModal.toggle();

            });


        });
    </script>


</div>
