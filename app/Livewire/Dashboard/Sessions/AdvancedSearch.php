<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Models\Group;
use App\Models\Session;
use App\Models\Subject;
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

    public function mount(): void
    {
        $this->availableSubjects = Group::with('subjects')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $sessions = Session::query();

        if ($this->sessionNumber) {
            $sessions->where('session_number', trim($this->sessionNumber));
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
                    $query->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->search) . "%' ")
                        ->orWhere('primary_phone_number', 'LIKE', '%' . trim($this->student) . '%')
                        ->orWhere('secondary_phone_number', 'LIKE', '%' . trim($this->student) . '%')
                        ->orWhere('email', 'LIKE', '%' . trim($this->student) . '%');
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
