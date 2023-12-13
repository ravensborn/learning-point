<?php

namespace App\Livewire\Dashboard\Families;

use App\Models\Family;
use App\Traits\FamilyModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, FamilyModalFunctions;

    public int $perPage = 10;
    public string $search = '';

    public function mount() {
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $families = Family::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $families->where('name', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhereHas('students', function ($query) {
                    $query->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->search) . "%' ")
                        ->orWhere('primary_phone_number', 'LIKE', '%' . trim($this->search) . '%')
                        ->orWhere('secondary_phone_number', 'LIKE', '%' . trim($this->search) . '%')
                        ->orWhere('email', 'LIKE', '%' . trim($this->search) . '%');
            });
        }

        $families = $families->paginate($this->perPage);

        return view('livewire.dashboard.families.index', [
            'families' => $families
        ]);
    }


    public function update(): void
    {

        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function store(): void
    {
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
