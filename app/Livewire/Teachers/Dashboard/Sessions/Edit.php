<?php

namespace App\Livewire\Teachers\Dashboard\Sessions;

use App\Livewire\Forms\SessionForm;
use App\Models\Group;
use App\Models\Session;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{

    public $session;
    public SessionForm $sessionForm;
    public $availableSubjects;
    public $availableTypes;


    public function update(): void
    {

        $this->sessionForm->user_id = null;
        $this->sessionForm->teacher_id = auth()->guard('teacher')->user()->id;
        $this->sessionForm->update();

        foreach ($this->session->attendees as $attendee) {
//            Attendee::calculateStudentCharge($this->session->subject_id, $attendee->student->studentRates, $this->session->attendees
//                ->where('attending', true)->count());

            $this->session->updateAttendeeSessionCharge($attendee->id, false);

        }

        $this->redirectRoute('teacher.dashboard.sessions.index');
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

        if ($session->status == Session::STATUS_COMPLETED) {
            $this->redirectRoute('teacher.dashboard.sessions.index');
        }

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

    #[Layout('layouts.teachers-dashboard')]
    public function render()
    {
        return view('livewire.teachers.dashboard.sessions.edit');
    }

}
