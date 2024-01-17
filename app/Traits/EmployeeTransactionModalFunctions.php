<?php

namespace App\Traits;

use App\Livewire\Forms\TransactionForm;
use App\Models\Employee;
use App\Models\Transaction;

trait EmployeeTransactionModalFunctions
{
    public TransactionForm $form;

    public string $transferAmount = '';
    public string $transferToQuery = '';
    public $transferToList;
    public int $transferToId = 0;
    public string $transferDescription = '';

    public function selectTransferTo($id): void
    {
        $this->transferToId = $id;

        $employee = Employee::find($id);
        $this->transferDescription = 'Internal transfer to employee ' . $employee->name . '.';
    }
    public function updatedTransferToQuery(): void
    {
        if ($this->transferToQuery) {

            $search = trim($this->transferToQuery);

            $this->transferToList = Employee::where('name', 'LIKE', '%' . trim($search) . '%')
                ->orWhere('phone_number', 'LIKE', '%' . trim($search) . '%')
                ->orWhere('email', 'LIKE', '%' . trim($search) . '%')
                ->limit(5)
                ->get();

        } else {
            $this->transferToList = collect();
        }
    }

    public function resetTransferForm(): void
    {
        $this->transferToQuery = '';
        $this->transferToList = collect();
        $this->transferDescription = '';
        $this->transferAmount = 0;
        $this->transferToId = 0;
        $this->resetErrorBag();
        $this->dispatch('close-all-modals');
    }

    public function prepareItemEditing($id): void
    {
        $this->form->setup($id);
        $this->dispatch('toggle-modal-edit');
    }

    public int $itemToDeleteId = 0;

    public function startItemDeletion(): bool
    {
        $item = Transaction::findOrFail($this->itemToDeleteId);
        $item->sync(true);
        $item->delete();
        $this->employee = Employee::find($this->employee->id);
        $this->dispatch('toggle-modal-delete-confirmation');

        return true;
    }

    public function prepareItemDeletion($id): void
    {
        $this->itemToDeleteId = $id;
        $this->dispatch('toggle-modal-delete-confirmation');
    }

    public function resetItemDeletion(): void
    {
        $this->itemToDeleteId = 0;
        $this->dispatch('close-all-modals');
    }

    public function resetForm(): void
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->dispatch('close-all-modals');
    }

}
