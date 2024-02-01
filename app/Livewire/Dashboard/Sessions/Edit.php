<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Livewire\Forms\SessionForm;
use App\Models\Attendee;
use App\Models\Group;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{

    public $session;
    public SessionForm $sessionForm;

    public $availableTeachers;
    public $availableSubjects;
    public $availableTypes;


    public function update(): void
    {

        $this->sessionForm->user_id = auth()->user()->id;
        $this->sessionForm->update();

        foreach ($this->session->attendees as $attendee) {
//            Attendee::calculateStudentCharge($this->session->subject_id, $attendee->student->studentRates, $this->session->attendees
//                ->where('attending', true)->count());

            $this->session->updateAttendeeSessionCharge($attendee->id, false);

        }

        $this->redirectRoute('dashboard.sessions.manage', $this->sessionForm->model->id);
    }



    public function updatedSessionFormTimeIn(): void
    {
        $this->sessionForm->time_out = $this->sessionForm->time_in;
    }


    public function loadCurrentSessionDetails(): void
    {
        $this->sessionForm->setup($this->session->id);
    }

    public function mount(Session $session): void
    {

        $this->session = $session;

        $this->availableTeachers = Teacher::orderBy('name')->get();
        $this->availableSubjects = Group::with([
            'subjects' => function ($query) {
                $query->orderBy('name');
            }
        ])->where('model', Subject::class)
            ->get()
            ->filter(function ($group) {
                if ($group->subjects->count()) {
                    return $group;
                }
            });


        $this->availableTypes = Session::TYPES;

        $this->loadCurrentSessionDetails();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.sessions.edit');
    }

}
