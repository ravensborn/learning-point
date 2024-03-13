<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Models\Session;
use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowCompleted extends Component
{

    public $session;

    public string $duration;

    public $settings;

    public function mount(Session $session): void
    {
        if($session->status != Session::STATUS_COMPLETED) {
            $this->redirectRoute('dashboard.sessions.manage', $session->id);
        }
        $this->session = $session;

        $this->duration = round($session->time_out->floatDiffInRealHours($session->time_in), 2);
        $this->settings = Setting::find(1);
    }

    public function getDiffForLP(): string
    {
        $hours = $this->session->time_out->diffInHours($this->session->time_in);
        $minutes = $this->session->time_out->diffInMinutes($this->session->time_in) % 60;

        if ($hours == 0) {
            $formattedDiff = "{$minutes} min";
        } elseif ($minutes == 0) {
            $formattedDiff = "{$hours} h";
        } else {
            $formattedDiff = "{$hours} h {$minutes} min";
        }

        return $formattedDiff;
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
