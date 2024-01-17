<?php

namespace App\Livewire\Dashboard\Teachers;

use App\Models\Teacher;
use App\Traits\TeacherModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, TeacherModalFunctions;

    public int $perPage = 10;
    public string $search = '';

    public function mount()
    {


    }

    #[Layout('layouts.app')]
    public function render()
    {
        $teachers = Teacher::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $teachers->where('name', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhere('email', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhere('phone_number', 'LIKE', '%' . trim($this->search) . '%');
        }

        $teachers = $teachers->paginate($this->perPage);

        return view('livewire.dashboard.teachers.index', [
            'teachers' => $teachers
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
