<?php

namespace App\Livewire\Dashboard\Students;

use App\Models\Student;
use App\Traits\StudentModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, StudentModalFunctions;


    public int $perPage = 12;
    public string $search = '';


    #[Layout('layouts.app')]
    public function render()
    {
        $students = Student::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $students->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');

        }

        $students = $students->paginate($this->perPage);

        return view('livewire.dashboard.students.index', [
            'students' => $students
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
