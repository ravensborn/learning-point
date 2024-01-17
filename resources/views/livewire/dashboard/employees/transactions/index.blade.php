<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage {{ ucfirst($employee->name) }} Transactions
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#modal-transfer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 21v-6"/>
                                <path d="M20 6l-3 -3l-3 3"/>
                                <path d="M17 3v18"/>
                                <path d="M10 18l-3 3l-3 -3"/>
                                <path d="M7 3v2"/>
                                <path d="M7 9v2"/>
                            </svg>
                            Transfer
                        </a>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#modal-create">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            New Transaction
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
                                <h3 class="card-title">Transaction List</h3>
                                <div @class(['text-danger' => ($employee->wallet < 0)])>
                                    Wallet:
                                    ${{ number_format($employee->wallet, 2) }}
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
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>

                                    <th class="w-1">No.</th>
                                    <th>Series</th>
                                    <th>Action</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($transactions as $transaction)
                                    <tr wire:key="{{ $transaction->id }}">
                                        <td>
                                            <span class="text-secondary">
                                                {{ ($transactions->currentpage()-1) * $transactions->perpage() + $loop->index + 1 }}
                                            </span>
                                        </td>
                                        <td>{{ $transaction->number }}</td>
                                        <td>{{ $transaction->type_name }}</td>
                                        <td class="{{ $transaction->type_color_class }}">
                                            {{ $transaction->type_prefix_character }}
                                            ${{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td class="text-wrap">{{ $transaction->description }}</td>
                                        <td>{{ ucfirst($transaction->user->name) }}</td>
                                        <td>{{ $transaction->created_at->format('Y-m-d / h:i A') }}</td>

                                        <td class="text-end">
                                            <a class="btn align-text-top"
                                               href="{{ route('dashboard.transactions.print', ['transaction' => $transaction->id]) }}">
                                                Print
                                            </a>
                                            <span class="dropdown">
                                                  <button class="btn dropdown-toggle align-text-top"
                                                          data-bs-boundary="viewport"
                                                          data-bs-toggle="dropdown">
                                                      Actions
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-end">
                                                    <button class="dropdown-item"
                                                            wire:click="prepareItemDeletion({{ $transaction->id }})">Delete</button>
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
                                <span>{{  $transactions->firstItem()  }}</span>
                                to
                                <span>{{ $transactions->lastItem() }}</span>
                                of
                                <span> {{ $transactions->total() }}</span>
                                entries
                            </p>
                            <div class="m-0 ms-auto">
                                {{ $transactions->links() }}
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
                    <h5 class="modal-title">New Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-create-form" wire:submit="store">
                        <div class="row mb-3">
                            <div class="col-12 mb-3 col-md-6 mb-md-0">
                                <div>
                                    <label for="type" class="form-label required">Action</label>
                                    <select wire:model.live="form.type" id="type" class="form-control">
                                        <option value="">-- Select an action --</option>
                                        @foreach($availableTransactionTypes as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.type')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="amount" class="form-label required">Amount (&dollar;)</label>
                                    <input type="text" wire:model="form.amount" class="form-control" id="amount"
                                           placeholder="100">
                                    @error('form.amount')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3 mb-md-0">
                                <div>
                                    <label for="description" class="form-label required">Description</label>
                                    <textarea id="description" wire:model="form.description" class="form-control"
                                              cols="30" rows="10"></textarea>
                                    @error('form.description')
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
    <div class="modal modal-blur fade" id="modal-transfer" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if($employee->wallet > 0)
                        <form id="modal-transfer-form" wire:submit="transfer">
                            <div class="row mb-3">
                                <div class="col-12 mb-3">
                                    <div>
                                        <label for="transfer_to_query" class="form-label required">To</label>
                                        <input type="text" wire:model.live="transferToQuery" class="form-control"
                                               id="transfer_to_query"
                                               placeholder="Search employees...">
                                        @error('transferToQuery')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @error('transferToId')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="d-flex flex-column gap-2 mt-3 justify-center">
                                        @forelse($transferToList as $employee)
                                            @if($employee->id == $transferToId)
                                                <div class="badge cursor-pointer border-success">
                                                    {{ $employee->name }}
                                                </div>
                                            @else
                                                <div class="badge cursor-pointer"
                                                     wire:click="selectTransferTo({{ $employee->id }})">
                                                    {{ $employee->name }}
                                                </div>
                                            @endif
                                        @empty
                                            <div class="text-secondary">
                                                No members to show, please adjust your search query.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div>
                                        <label for="transfer_amount" class="form-label required">Amount
                                            (&dollar;)</label>
                                        <input type="text" wire:model="transferAmount" class="form-control"
                                               id="transfer_amount"
                                               placeholder="100">
                                        @error('transferAmount')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-3 mb-md-0">
                                    <div>
                                        <label for="transfer_description"
                                               class="form-label required">Description</label>
                                        <textarea id="transfer_description" wire:model="transferDescription"
                                                  class="form-control"
                                                  cols="30" rows="10"></textarea>
                                        @error('transferDescription')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div>
                            Employee has insufficient wallet amount.
                        </div>
                    @endif

                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-transfer-form"
                            wire:loading.attr="disabled">
                        <!--<editor-fold desc="SVG ICON">-->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                             viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        <!--</editor-fold>-->
                        Transfer
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
            });
            document.getElementById('modal-transfer').addEventListener('hidden.bs.modal', event => {
                @this.
                resetTransferForm();
            })

            const createModal = new bootstrap.Modal('#modal-create');
            const transferModal = new bootstrap.Modal('#modal-transfer');
            const deleteModal = new bootstrap.Modal('#modal-delete');

            @this.
            on('close-all-modals', (event) => {
                createModal.hide();
                transferModal.hide();
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

            @this.
            on('toggle-modal-transfer', (event) => {
                transferModal.toggle();
            });
        });
    </script>


</div>
