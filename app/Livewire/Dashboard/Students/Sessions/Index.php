<?php

namespace App\Livewire\Dashboard\Students\Sessions;

use App\Models\Session;
use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;

    public $student;

    public int $perPage = 10;
    public string $search = '';

    public function mount(Student $student): void
    {
        $this->student = $student;

    }

    #[Layout('layouts.app')]
    public function render()
    {
        $sessions = Session::whereHas('attendees', function ($q) {
            $q->where('student_id', $this->student->id);
        })->orderBy('id', 'desc');

        if ($this->search) {

            $this->resetPage();

            $sessions->where('number', 'LIKE', '%' . trim($this->search) . '%');
        }

        $sessions = $sessions->paginate($this->perPage);

        return view('livewire.dashboard.students.sessions.index', [
            'sessions' => $sessions
        ]);
    }

}
