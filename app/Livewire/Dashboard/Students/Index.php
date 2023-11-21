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

    public array $selectedStudents = [];

    #[Layout('layouts.app')]
    public function render()
    {

        $students = Student::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $students->where('first_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');

        }

        $students = $students->paginate($this->perPage);

        return view('livewire.dashboard.students.index', [
            'students' => $students
        ]);
    }

    public function isMultiSelectMode(): bool
    {
        return count($this->selectedStudents) > 0;
    }

    public function getNumberOfSelectedStudents($mode = null): int|string {

        $count = count($this->selectedStudents);

        if($mode == 'with-text') {
            if($count == 1) {
                return 'Selected ' . $count . ' student';
            }

            return 'Selected ' . $count . ' students';
        }
        return $count;
    }

    public function bulkActions($action): void
    {
        if($action == 'delete') {
            Student::destroy($this->selectedStudents);
            $this->bulkActions('clear');
        }
        if($action == 'clear') {
            $this->selectedStudents = [];
        }
    }


    public function update(): void
    {

        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

}
