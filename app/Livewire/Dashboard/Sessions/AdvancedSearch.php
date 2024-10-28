<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Models\Group;
use App\Models\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AdvancedSearch extends Component
{
    use LivewireAlert, WithPagination;

    public $session;
    public int $perPage = 10;
    public $availableSubjects;

    public string $sessionNumber = '';
    public string $teacher = '';
    public string $family = '';
    public string $student = '';
    public string $subjectId = '';
    public string $group = '';
    public string $sessionDate = '';
    public string $sessionStatus = '';
    public string $sessionType = '';

    public bool $showFilters = false;

    public function mount(): void
    {
        $this->availableSubjects = Group::with('subjects')->get();
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $sessions = Session::query();

        if ($this->sessionNumber) {
            $sessions->where('number', 'LIKE',  '%' . trim($this->sessionNumber) . '%');
        }

        if ($this->teacher) {
            $sessions->whereHas('teacher', function ($query) {
                $query->where('name', 'like', '%' . trim($this->teacher) . '%');
            });
        }

        if ($this->family) {
            $sessions->whereHas('attendees', function ($query) {
                $query->whereHas('student', function ($query) {
                    $query->whereHas('family', function ($query) {
                        $query->where('name', 'like', '%' . trim($this->family) . '%');
                    });
                });
            });
        }

        if ($this->student) {
            $sessions->whereHas('attendees', function ($query) {
                $query->whereHas('student', function ($query) {
                    $search = trim($this->student);
                    $query->whereRaw("concat(trim(first_name), ' ', trim(middle_name), ' ', trim(last_name)) like ?", ["%{$search}%"])
                        ->orWhere('primary_phone_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('secondary_phone_number', 'LIKE', '%' . $search. '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                });
            });
        }

        if($this->subjectId) {
            $sessions->where('subject_id', $this->subjectId);
        }

        if($this->sessionDate) {
            $sessions->whereDate('time_in', $this->sessionDate);
        }

        if($this->group) {
            $sessions->whereHas('subject', function ($query) {
                $query->whereHas('group', function ($query) {
                    $query->where('name', 'like', '%' . trim($this->group) . '%');
                });
            });
        }


        if(array_key_exists($this->sessionStatus, Session::STATUSES)) {
            $sessions->where('status', $this->sessionStatus);

        }

        if(array_key_exists($this->sessionType, Session::TYPES)) {
            $sessions->where('type', $this->sessionType);
        }

        $sessions = $sessions->paginate($this->perPage);

        return view('livewire.dashboard.sessions.advanced-search', [
            'sessions' => $sessions
        ]);
    }

}
