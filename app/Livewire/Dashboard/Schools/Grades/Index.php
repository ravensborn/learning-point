<?php

namespace App\Livewire\Dashboard\Schools\Grades;

use App\Models\Grade;
use App\Models\School;
use App\Traits\GradeModalFunctions;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, GradeModalFunctions;

    public int $perPage = 10;
    public string $search = '';
    public School $school;

    public function mount(School $school)
    {

        $this->school = $school;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $grades = Grade::query()->where('school_id', $this->school->id)
            ->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $grades->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        $grades = $grades->paginate($this->perPage);

        return view('livewire.dashboard.schools.grades.index', [
            'grades' => $grades
        ]);
    }


    public function update(): void
    {

        if (Grade::where('name', trim($this->form->name))
            ->where('school_id', $this->school->id)
            ->where('id', '!=', $this->form->model->id)
            ->first()) {
            throw ValidationException::withMessages(['form.name' => 'Grade with the same name already exist.']);
        }

        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function store(): void
    {
        if (Grade::where('name', trim($this->form->name))
            ->where('school_id', $this->school->id)
            ->first()) {
            throw ValidationException::withMessages(['form.name' => 'Grade with the same name already exist.']);
        }

        $this->form->school_id = $this->school->id;
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
