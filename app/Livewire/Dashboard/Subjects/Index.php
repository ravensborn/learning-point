<?php

namespace App\Livewire\Dashboard\Subjects;

use App\Models\Group;
use App\Models\Subject;
use App\Traits\SubjectModalFunctions;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, SubjectModalFunctions;


    public int $perPage = 10;
    public string $search = '';

    public Collection $groups;

    public function mount() {

        $this->groups = Group::orderBy('created_at', 'desc')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $subjects = Subject::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $subjects->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        $subjects = $subjects->paginate($this->perPage);

            return view('livewire.dashboard.subjects.index', [
                'subjects' => $subjects
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
