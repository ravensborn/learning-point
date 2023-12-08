<?php

namespace App\Traits;

use App\Livewire\Forms\GradeForm;
use App\Models\Grade;

trait GradeModalFunctions {


    public GradeForm $form;

    public function prepareItemEditing($id): void
    {
        $this->form->setup($id);
        $this->dispatch('toggle-modal-edit');
    }

    public int $itemToDeleteId = 0;

    public function startItemDeletion(): bool
    {
        $item = Grade::findOrFail($this->itemToDeleteId);

        if($item->students->count()) {

            $this->addError('delete', 'Cannot be deleted, this grade has related students.');

            return false;
        }

        $item->delete();
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
