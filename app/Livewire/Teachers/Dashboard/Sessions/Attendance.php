<?php

namespace App\Livewire\Teachers\Dashboard\Sessions;

use App\Livewire\Forms\SessionForm;
use App\Models\Attendee;
use App\Models\Group;
use App\Models\Session;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Attendance extends Component
{

    public $session;

    public function mount(Session $session): void
    {
        $this->session = $session;
    }

    public function reloadSession(): void
    {
        $this->session = Session::find($this->session->id);
    }

    public function toggleStudentAttending($attendeeId): void
    {
        $attendee = Attendee::find($attendeeId);

        if ($attendee) {

            $attendee->update([
                'attending' => !$attendee->attending
            ]);

            foreach ($this->session->attendees as $attendee) {
                $this->session->updateAttendeeSessionCharge($attendee->id, false);
            }
        }

        $this->reloadSession();
    }

    #[Layout('layouts.teachers-dashboard')]
    public function render()
    {
        return view('livewire.teachers.dashboard.sessions.attendance');
    }

}
