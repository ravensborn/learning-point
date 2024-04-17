<?php

namespace App\Traits;

use App\Livewire\Forms\SubjectForm;
use App\Models\Subject;

trait SubjectModalFunctions
{
    
    public SubjectForm $form;

    public function prepareItemEditing($id): void
    {
        $this->form->setup($id);
        $this->dispatch('toggle-modal-edit');
    }

    public int $itemToDeleteId = 0;

    public function startItemDeletion(): void
    {
        $item = Subject::findOrFail($this->itemToDeleteId);

        if ($item->sessions->count()) {

            $this->addError('delete', 'Cannot be deleted, this session has related sessions.');

        } else {

            $item->delete();
            $this->dispatch('toggle-modal-delete-confirmation-hide');
        }
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
