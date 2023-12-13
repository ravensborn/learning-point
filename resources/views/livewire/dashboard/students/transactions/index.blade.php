<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage {{ ucfirst($student->full_name) }} Transactions
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
                            <h3 class="card-title">Transaction List</h3>
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
                                        <td>${{ number_format($transaction->amount, 2) }}</td>
                                        <td class="text-wrap">{{ $transaction->description }}</td>
                                        <td>{{ ucfirst($transaction->user->name) }}</td>
                                        <td>{{ $transaction->created_at->format('Y-m-d / h:i A') }}</td>
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

    <script>
        document.addEventListener('livewire:initialized', () => {

            document.getElementById('modal-create').addEventListener('hidden.bs.modal', event => {
                @this.
                resetForm();
            })

            const createModal = new bootstrap.Modal('#modal-create');

            @this.
            on('close-all-modals', (event) => {
                createModal.hide();
            });

            @this.
            on('toggle-modal-create', (event) => {
                createModal.toggle();

            });


        });
    </script>


</div>
