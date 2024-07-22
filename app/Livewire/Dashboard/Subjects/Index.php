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
    public string $selectedGroupId = '';

    public function mount()
    {

        $this->groups = Group::where('model', Subject::class)
            ->orderBy('name')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $subjects = Subject::query()->orderBy('name');

        if ($this->search) {

            $this->resetPage();
            $subjects->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        if ($this->selectedGroupId) {

            $this->resetPage();
            $subjects->where('group_id', '=', $this->selectedGroupId);
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
