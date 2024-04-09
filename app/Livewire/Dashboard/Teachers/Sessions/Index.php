<?php

namespace App\Livewire\Dashboard\Teachers\Sessions;

use App\Models\Session;
use App\Models\Teacher;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;

    public $teacher;


    public int $perPage = 3;
    public string $search = '';

    public bool $dateFiltering = false;
    public int $numberOfSessions = 0;
    public float $numberOfHours = 0;
    public $dateTo;
    public $dateFrom;

    public function loadTeacherStats($data): void
    {
        $this->numberOfSessions = $data->count();
        $this->numberOfHours = $data->sum(function ($session) {
            return $session->time_out->floatDiffInRealHours($session->time_in);
        });
    }

    public function toggleDateFiltering(): void
    {
        $this->dateFiltering = !$this->dateFiltering;
    }

    public function mount(Teacher $teacher): void
    {
        $this->teacher = $teacher;

    }

    #[Layout('layouts.app')]
    public function render()
    {
        $sessions = Session::where('teacher_id', $this->teacher->id)->orderBy('id', 'desc');

        if ($this->dateFiltering && ($this->dateFrom && $this->dateTo)) {

            $sessions->whereBetween('created_at', [
                $this->dateFrom,
                $this->dateTo
            ]);
        }

        $this->loadTeacherStats($sessions->get());

        if ($this->search) {
            $this->resetPage();
            $sessions->where('number', 'LIKE', '%' . trim($this->search) . '%');
        }

        $sessions = $sessions->paginate($this->perPage);

        return view('livewire.dashboard.teachers.sessions.index', [
            'sessions' => $sessions
        ]);
    }

}
