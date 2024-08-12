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
    public Collection $selectedGroups;
    public string $selectedGroupId = '';

    public function mount()
    {

        $this->groups = Group::where('model', Subject::class)
            ->orderBy('name')->get();

        $this->selectedGroups = collect();
    }

    public function updatedSelectedGroupId($id): void
    {
        $existingGroup = $this->selectedGroups->where('id', $id)->first();

        if (!$existingGroup) {

            $group = $this->groups->where('id', $id)->first();

            if ($group) {
                $this->selectedGroups->push($group);
            }


        }
    }

    public function removeGroup($id): void
    {
        $existingGroup = $this->selectedGroups->where('id', $id)->first();

        if ($existingGroup) {

            $this->selectedGroups = $this->selectedGroups->reject(function ($group) use ($existingGroup) {
                return $group->id === $existingGroup->id;
            });
        }

        $this->selectedGroupId = 'all';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $subjects = Subject::query()->orderBy('name');

        if ($this->search) {

            $this->resetPage();
            $subjects->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        if ($this->selectedGroups->isNotEmpty()) {

            $this->resetPage();

            $subjects->whereIn('group_id', $this->selectedGroups->pluck('id'));
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
