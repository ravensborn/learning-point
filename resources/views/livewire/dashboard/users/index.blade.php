<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Users
                    </h2>
                    <div class="text-secondary mt-1">{{ $users->firstItem() ?? 0  }} - {{ $users->lastItem() ?? 0  }}
                        of {{ $users->total()  }} people
                    </div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <label for="search_item"></label>
                        <input type="search" id="search_item" wire:model.live="search"
                               class="form-control d-inline-block w-9 me-3"
                               placeholder="Search users…">

                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#modal-create">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            New User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @forelse($users as $user)
                    <div class="col-md-6 col-lg-3" wire:key="{{ $user->id }}">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded"
                                      style="background-image: url('{{ $user->getFirstMediaUrl('avatar') }}')"></span>
                                <h3 class="m-0 mb-1">
                                    <a href="#">
                                        {{ ucfirst($user->name) }}
                                    </a>
                                </h3>
                                <div class="text-secondary">{{ $user->email }}</div>
                                <div class="mt-3">
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-purple-lt">{{ ucwords($role->name) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex">
                                <a href="#" wire:click="prepareItemEditing({{ $user->id  }})" class="card-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-edit icon me-2 text-muted"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                    Edit
                                </a>
                                <a href="#" wire:click="prepareItemDeletion({{ $user->id  }})" class="card-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-trash icon me-2 text-muted" width="24"
                                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                    Remove
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="empty">
                            <div class="empty-img"><img src="{{ asset('theme/static/illustrations/undraw_space_search_re_ttoj.svg') }}" height="128" alt="">
                            </div>
                            <p class="empty-title">No results found</p>
                            <p class="empty-subtitle text-secondary">
                                Try adjusting your search or filter to find what you're looking for.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{ $users->links() }}
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-create-form" wire:submit="store">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" wire:model="form.name" class="form-control" id="name"
                                           placeholder="Your full name">
                                    @error('form.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div>
                                    <label for="email" class="form-label">E-Mail Address</label>
                                    <input type="email" wire:model="form.email" class="form-control" id="email"
                                           placeholder="Your email address">
                                    @error('form.email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3 mb-md-0">
                                <div>
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" wire:model="form.password" class="form-control" id="password"
                                           placeholder="New password">
                                    @error('form.password')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3 mb-md-0">
                                <div>
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" wire:model="form.password_confirmation" class="form-control"
                                           id="confirm_password" placeholder="Confirm new password">
                                    @error('form.password_confirmation')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Gender</label>
                                <div class="form-check">
                                    <input type="radio" wire:model="form.gender" value="male" class="form-check-input"
                                           id="genderMaleRadioButton">
                                    <label class="form-check-label" for="genderMaleRadioButton">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" wire:model="form.gender" value="female" class="form-check-input"
                                           id="genderFemaleRadioButton">
                                    <label class="form-check-label" for="genderFemaleRadioButton">
                                        Female
                                    </label>
                                </div>

                                @error('form.gender')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror

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

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Save
                        <span wire:loading wire:target="store">
                            &nbsp; - Saving...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editing User {{ $form->name }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-update-form" wire:submit="update">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" wire:model="form.name" class="form-control" id="name"
                                           placeholder="Your full name">
                                    @error('form.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div>
                                    <label for="email" class="form-label">E-Mail Address</label>
                                    <input type="email" wire:model="form.email" class="form-control" id="email"
                                           placeholder="Your email address">
                                    @error('form.email')
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
                    <button class="btn btn-link link-secondary" wire:click="resetForm()">
                        Cancel
                    </button>
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-update-form"
                            wire:loading.attr="disabled" wire:target="update">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="44"
                             height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10"/>
                        </svg>
                        Update
                        <span wire:loading wire:target="update">
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


            document.getElementById('modal-edit').addEventListener('hidden.bs.modal', event => {
                @this.
                resetForm();
            });

            document.getElementById('modal-create').addEventListener('hidden.bs.modal', event => {
                @this.
                resetForm();
            })

            const createModal = new bootstrap.Modal('#modal-create');
            const editModal = new bootstrap.Modal('#modal-edit');
            const deleteModal = new bootstrap.Modal('#modal-delete');

            @this.
            on('close-all-modals', (event) => {
                createModal.hide();
                editModal.hide();
                deleteModal.hide();
            });

            @this.
            on('toggle-modal-delete-confirmation', (event) => {
                deleteModal.toggle();
            });

            @this.
            on('toggle-modal-edit', (event) => {
                editModal.toggle();
            });

            @this.
            on('toggle-modal-create', (event) => {
                createModal.toggle();

            });


        });
    </script>


</div>
