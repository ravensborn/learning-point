<?php

namespace App\Traits;

use App\Livewire\Forms\ExpenseForm;
use App\Models\Expense;

trait ExpenseModalFunctions {


    public ExpenseForm $form;

    public function prepareItemEditing($id): void
    {
        $this->form->setup($id);
        $this->dispatch('toggle-modal-edit');
    }

    public int $itemToDeleteId = 0;

    public function startItemDeletion(): void
    {
        $item = Expense::findOrFail($this->itemToDeleteId);
        $item->delete();
        $this->dispatch('toggle-modal-delete-confirmation-hide');
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
