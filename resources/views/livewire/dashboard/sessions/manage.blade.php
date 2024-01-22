<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Session
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">


            <div class="row row-deck row-cards">

                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Session Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created By</div>
                                    <div class="datagrid-content">{{ $session->user->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Created At</div>
                                    <div
                                        class="datagrid-content">{{ $session->created_at->format('Y-m-d / h:i A') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Teacher</div>
                                    <div class="datagrid-content">{{ $session->teacher->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Subject</div>
                                    <div class="datagrid-content">{{ $session->subject->group->name }}
                                        / {{ $session->subject->name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Time in</div>
                                    <div class="datagrid-content">{{ $session->time_in->format('Y-m-d / h:i A') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Time out</div>
                                    <div
                                        class="datagrid-content">{{ $session->time_out->format('Y-m-d / h:i A') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Type</div>
                                    <div class="datagrid-content">{{ $session->type_name }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status</div>
                                    <div class="datagrid-content">{{ $session->status_name }}</div>
                                </div>
                                @if($session->note)
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Note</div>
                                        <div class="datagrid-content">
                                            {{ $session->note }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h3 class="card-title">Actions</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($session->status == \App\Models\Session::STATUS_PENDING)
                                <div class="mt-2">
                                    <button class="btn btn-primary" wire:click="complete">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-checks" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 12l5 5l10 -10"/>
                                            <path d="M2 12l5 5m5 -5l5 -5"/>
                                        </svg>
                                        Complete $ {{ number_format($total, 2) }}
                                    </button>
                                </div>
                            @endif

                            @if($session->status == \App\Models\Session::STATUS_COMPLETED)
                                <span class="text-secondary">
                                    There are no actions at the moment.
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-deck row-cards mt-3">

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <h3 class="card-title">Charge List</h3>
                            <div>
                                @if($session->status == \App\Models\Session::STATUS_PENDING)
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
                                        New Item
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @foreach($session->students as $studentId => $student)
                            <h3>{{ $student['name'] }}</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="w-1">#</th>
                                    <th>Item</th>
                                    <th class="w-1">Amount</th>
                                    <th>Note</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($student['charge_list'] as $index => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>${{ number_format($item['amount'], 2) }}</td>
                                        <td>{{ $item['note'] }}</td>
                                        <td class="text-end">
                                            @if($session->status == \App\Models\Session::STATUS_PENDING)
                                                <button class="btn btn-sm btn-danger"
                                                        wire:click="removeItem({{ $studentId }}, {{ $index }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="icon icon-tabler icon-tabler-trash" width="24"
                                                         height="24"
                                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M4 7l16 0"/>
                                                        <path d="M10 11l0 6"/>
                                                        <path d="M14 11l0 6"/>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                    </svg>
                                                    Remove
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center text-secondary">
                                        <td colspan="5">There are no items at the moment.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        @endforeach


                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Charge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-create-form" wire:submit="storeChargeItem">
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="student_id" class="form-label required">Student</label>
                                    <select wire:model="student_id" class="form-control" id="student_id">
                                        <option value="">-- Select Student --</option>
                                        @foreach($session->students as $studentId => $student)
                                            <option value="{{ $studentId }}">
                                                {{ $student['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="description" class="form-label required">Item</label>
                                    <input type="text" wire:model="description" class="form-control"
                                           id="item description"
                                           placeholder="Item description">
                                    @error('description')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="amount" class="form-label required">Amount</label>
                                    <input type="text" wire:model="amount" class="form-control" id="amount"
                                           placeholder="10">
                                    @error('amount')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div>
                                    <label for="note" class="form-label">Note</label>
                                    <input type="text" wire:model="note" class="form-control"
                                           id="note"
                                           placeholder="Note">
                                    @error('note')
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
                            wire:loading.attr="disabled" wire:target="storeChargeItem">

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
                        <span wire:loading wire:target="storeChargeItem">
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
