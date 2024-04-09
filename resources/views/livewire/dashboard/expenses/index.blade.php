<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Expenses
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#modal-create">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            New Expense
                        </a>
                    </div>
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
                                 wire:target="loadExpenseStats, dateFrom, dateTo">

                                @foreach($expenseStats as $item)
                                    <div class="col-3">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <span class="badge bg-success"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#"
                                                   wire:click.prevent="filterByGroup({{ $item['groupId'] }})"
                                                   class="text-reset d-block text-truncate">
                                                    @if($item['groupId'] == $filterByGroupId)
                                                        <span class="text-info fw-bold">
                                                            {{ $item['name'] }}
                                                        </span>
                                                    @else
                                                        {{ $item['name'] }}
                                                    @endif
                                                </a>
                                                <div class="text-secondary text-truncate mt-n1">
                                                    ${{ number_format($item['amount'], 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div wire:loading wire:target="loadExpenseStats, dateFrom, dateTo">
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
                            <h3 class="card-title">Expense List</h3>
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
                                    <th>
                                        Name
                                    </th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Group</th>
                                    <th>Note</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($expenses as $expense)
                                    <tr wire:key="{{ $expense->id }}">

                                        <td>
                                                <span class="text-secondary">
                                                    {{ ($expenses->currentpage()-1) * $expenses->perpage() + $loop->index + 1 }}
                                                </span>
                                        </td>
                                        <td>
                                            {{ ucfirst($expense->name) }}
                                        </td>
                                        <td>
                                            ${{ number_format($expense->amount, 2) }}
                                        </td>
                                        <td>
                                            {{ $expense->date->format('Y-m-d') }}
                                        </td>
                                        <td>
                                            {{ ucfirst($expense->group->name) }}
                                        </td>
                                        <td>
                                            {{ $expense->note }}
                                        </td>
                                        <td>
                                            {{ $expense->created_at->format('Y-m-d') }}
                                        </td>

                                        <td class="text-end">
                                                <span class="dropdown">
                                                  <button class="btn dropdown-toggle align-text-top"
                                                          data-bs-boundary="viewport"
                                                          data-bs-toggle="dropdown">Actions</button>
                                                  <div class="dropdown-menu dropdown-menu-end">
                                                    <button class="dropdown-item"
                                                            wire:click="prepareItemEditing({{ $expense->id  }})">Edit</button>
                                                    <button class="dropdown-item"
                                                            wire:click="prepareItemDeletion({{ $expense->id }})">Delete</button>
                                                  </div>
                                                </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
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
                                <span>{{  $expenses->firstItem()  }}</span>
                                to
                                <span>{{ $expenses->lastItem() }}</span>
                                of
                                <span> {{ $expenses->total() }}</span>
                                entries
                            </p>
                            <div class="m-0 ms-auto">
                                {{ $expenses->links() }}
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
                    <h5 class="modal-title">New Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-create-form" wire:submit="store">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <div>
                                    <label for="name" class="form-label required">Name</label>
                                    <input type="text" wire:model="form.name" class="form-control" id="name"
                                           placeholder="Expense name">
                                    @error('form.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="amount" class="form-label required">Amount
                                        (&dollar;)</label>
                                    <input type="text" wire:model="form.amount" class="form-control"
                                           id="amount"
                                           placeholder="100">
                                    @error('form.amount')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="date" class="form-label required">Date</label>
                                    <input type="date" wire:model="form.date" class="form-control"
                                           id="date">
                                    @error('form.date')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div>
                                    <label for="group_id" class="form-label required">Group</label>
                                    <select wire:model="form.group_id" id="group_id" class="form-control">
                                        <option value="">-- Select a group --</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.group_id')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <label for="note" class="form-label">Note</label>
                                    <textarea id="note" cols="30" rows="3" class="form-control" wire:model="form.note"></textarea>
                                    @error('form.note')
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
                    <h5 class="modal-title">Editing Expense {{ $form->name }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-update-form" wire:submit="update">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <div>
                                    <label for="name" class="form-label required">Name</label>
                                    <input type="text" wire:model="form.name" class="form-control" id="name"
                                           placeholder="Expense name">
                                    @error('form.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="amount" class="form-label required">Amount
                                        (&dollar;)</label>
                                    <input type="text" wire:model="form.amount" class="form-control"
                                           id="amount"
                                           placeholder="100">
                                    @error('form.amount')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="date" class="form-label required">Date</label>
                                    <input type="date" wire:model="form.date" class="form-control"
                                           id="date">
                                    @error('form.date')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div>
                                    <label for="group_id" class="form-label required">Group</label>
                                    <select wire:model="form.group_id" id="group_id" class="form-control">
                                        <option value="">-- Select a group --</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.group_id')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <label for="note" class="form-label required">Note</label>
                                    <textarea id="note" cols="30" rows="3" class="form-control" wire:model="form.note"></textarea>
                                    @error('form.note')
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
