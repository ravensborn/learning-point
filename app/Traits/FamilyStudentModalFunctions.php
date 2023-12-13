<?php

namespace App\Traits;

use App\Livewire\Forms\FamilyStudentForm;
use App\Models\Student;
use Illuminate\Support\Collection;

trait FamilyStudentModalFunctions
{
    public FamilyStudentForm $form;

    public int $itemToDeleteId = 0;

    public function startItemDeletion(): bool
    {
        $item = Student::findOrFail($this->itemToDeleteId);

        $item->update([
            'family_id' => null,
        ]);

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
        $this->memberSearchQuery = '';
        $this->searchedMemberList = collect();
        $this->selectedMemberId = 0;
        $this->resetErrorBag();
        $this->dispatch('close-all-modals');
    }

}
