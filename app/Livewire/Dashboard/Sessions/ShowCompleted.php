<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Models\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowCompleted extends Component
{

    public $session;

    public string $duration;

    public function mount(Session $session): void
    {
        if($session->status != Session::STATUS_COMPLETED) {
            $this->redirectRoute('dashboard.sessions.manage', $session->id);
        }
        $this->session = $session;

        $this->duration = $session->time_out->floatDiffInRealHours($session->time_in);
    }

    public function calculateAttendeeChargeList($attendeeId): int
    {
        $attendee = $this->session->attendees->find($attendeeId);

        if ($attendee) {

            if (!$attendee->charged) {
                return 0;
            }

            $sum = 0;

            if ($attendee->attending) {
                foreach ($attendee->charge_list as $item) {
                    if ($item['rated']) {
                        $sum = $sum + ($item['amount'] * $this->duration);
                    } else {
                        $sum = $sum + $item['amount'];
                    }
                }
            } else {
                foreach ($attendee->cancellation_charge_list as $item) {
                    if ($item['rated']) {
                        $sum = $sum + ($item['amount'] * $this->duration);
                    } else {
                        $sum = $sum + $item['amount'];
                    }
                }
            }

            return $sum;

        }

        return 0;
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.sessions.show-completed');
    }

}
