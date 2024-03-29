<?php

namespace App\Livewire\Dashboard\Employees\Transactions;

use App\Models\Employee;
use App\Models\Transaction;
use App\Traits\EmployeeTransactionModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;


class Index extends Component
{
    use WithPagination, EmployeeTransactionModalFunctions;

    public $employee;
    public array $availableTransactionTypes = [];
    public int $perPage = 10;
    public string $search = '';


    public function mount(Employee $employee): void
    {
        $this->employee = $employee;
        $this->availableTransactionTypes = Transaction::TYPES;
        $this->transferToList = collect();
    }


    public function update(): void
    {
        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function transfer(): void
    {
        $this->validate([
            'transferToId' => 'required|integer|exists:employees,id',
            'transferAmount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'transferDescription' => 'required|string|max:10000',
        ]);

        if($this->employee->wallet > 0) {

            if($this->transferAmount > $this->employee->wallet) {

                throw ValidationException::withMessages(['transferAmount' => 'Amount must be less than or equal to current wallet.']);
            }

            $this->form->transfer(Employee::class, $this->employee->id, $this->transferToId, $this->transferAmount, $this->transferDescription);
            $this->employee = Employee::find($this->employee->id);
            $this->dispatch('close-all-modals');

        }
    }

    public function store(): void
    {
        $this->form->transactable_id = $this->employee->id;
        $this->form->store(Employee::class);
        $this->form->model->sync();

        $this->dispatch('toggle-modal-create');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $transactions = $this->employee->transactions()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $transactions->where('number', 'LIKE', '%' . trim($this->search) . '%');
        }

        $transactions = $transactions->paginate($this->perPage);

        return view('livewire.dashboard.employees.transactions.index', [
            'transactions' => $transactions
        ]);
    }

}
