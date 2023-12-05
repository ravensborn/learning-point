<?php

namespace App\Livewire\Dashboard\Schools;

use App\Models\School;
use App\Traits\SchoolModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, SchoolModalFunctions;

    public int $perPage = 10;
    public string $search = '';

    public function mount() {
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $schools = School::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $schools->where('name', 'LIKE', '%' . $this->search . '%');
        }

        $schools = $schools->paginate($this->perPage);

        return view('livewire.dashboard.schools.index', [
            'schools' => $schools
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
