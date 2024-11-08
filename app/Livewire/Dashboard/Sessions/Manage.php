<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Livewire\Forms\TransactionForm;
use App\Models\Attendee;
use App\Models\Session;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Manage extends Component
{
    use LivewireAlert;
    public TransactionForm $transactionForm;

    public $session;

    public float $duration = 0;

    public $settings;

    public float $sessionTotal = 0;

    public string $chargeModalTitle = 'Add Charge';

    public function setAuthor(): void
    {
        $this->session->update([
            'user_id' => auth()->user()->id,
        ]);
    }

    public function mount(Session $session): void
    {

        if (!$session->user) {
            $this->setAuthor();
        }

        if ($session->status == Session::STATUS_COMPLETED) {
            $this->redirectRoute('dashboard.sessions.show-completed', $session->id);
        }

        $this->session = $session;
        $this->duration = round($session->time_out->floatDiffInRealHours($session->time_in), 2);
        $this->foundStudents = collect();
        $this->settings = Setting::find(1);
    }

//    public function getDiffForLP(): string
//    {
//        $hours = $this->session->time_out->diffInHours($this->session->time_in);
//        $minutes = $this->session->time_out->diffInMinutes($this->session->time_in) % 60;
//
//        if ($hours == 0) {
//            $formattedDiff = "{$minutes} min";
//        } elseif ($minutes == 0) {
//            $formattedDiff = "{$hours} h";
//        } else {
//            $formattedDiff = "{$hours} h {$minutes} min";
//        }
//
//        return $formattedDiff;
//    }

    public function calculateAttendeeChargeList($attendeeId): float
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


    public function updateAllAttendeeSessionCharges($createIfNotExist): void
    {

        foreach ($this->session->attendees as $attendee) {
            $this->session->updateAttendeeSessionCharge($attendee->id, $createIfNotExist);
        }

    }

    public function updateAttendeeSessionCharge($attendeeId): void
    {
        $this->session->updateAttendeeSessionCharge($attendeeId, true);
    }

    public int $removingChargeListAttendeeId = 0;
    public int $removingChargeListIndex = -1;

    public function removeCharge($attendeeId, $index): void
    {
        $attendee = $this->session->attendees->find($attendeeId);

        if ($index == $this->removingChargeListIndex && $attendeeId == $this->removingChargeListAttendeeId) {

            if ($attendee) {

                $chargeListKey = $attendee->attending ? 'charge_list' : 'cancellation_charge_list';
                $chargeList = $attendee->$chargeListKey;

                unset($chargeList[$index]);

                $attendee->update([
                    $chargeListKey => $chargeList
                ]);

            }
        } else {
            $this->removingChargeListIndex = $index;
            $this->removingChargeListAttendeeId = $attendeeId;
        }

    }

    public string $attendeeToAddChargeId = '';
    public string $attendeeToEditChargeId = '';
    public string $attendeeToEditChargeIndex = '';
    public string $attendeeChargeName = '';
    public string $attendeeChargeAmount = '';
    public string $attendeeChargeType = 'rated';
    public string $attendeeChargeNote = '';

    public function showEditChargeModal($attendeeId, $index): void
    {
        $this->attendeeToEditChargeId = $attendeeId;
        $this->attendeeToEditChargeIndex = $index;

        $attendee = $this->session->attendees->find($attendeeId);
        $chargeListKey = $attendee->attending ? 'charge_list' : 'cancellation_charge_list';
        $chargeList = $attendee->{$chargeListKey}[$index];

        $this->attendeeChargeName = $chargeList['name'];
        $this->attendeeChargeAmount = $chargeList['amount'];
        $this->attendeeChargeType = $chargeList['rated'] ? 'rated' : 'unrated';
        $this->attendeeChargeNote = $chargeList['note'];

        $this->dispatch('toggle-modal-edit-charge');
    }

    public function showAddChargeModal($attendeeId): void
    {

        $this->chargeModalTitle = 'Add Charge';

        if($attendeeId == 'all') {
            $this->chargeModalTitle = 'Add Bulk Charge';
        }

        if($attendeeId == 'all-cancellation') {
            $this->chargeModalTitle = 'Add Bulk Cancellation Charge';
        }

        $this->attendeeToAddChargeId = $attendeeId;
        $this->dispatch('toggle-modal-charge-student');
    }

    public function addCharge(): void
    {
        $this->validate([
            'attendeeChargeName' => ['required', 'string', 'max:100'],
            'attendeeChargeNote' => ['nullable', 'string', 'max:1000'],
            'attendeeChargeAmount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'attendeeChargeType' => ['required', 'string', 'in:rated,unrated'],
        ]);

        if ($this->attendeeToAddChargeId == 'all' || $this->attendeeToAddChargeId == 'all-cancellation') {
            foreach ($this->session->attendees->where('attending', ($this->attendeeToAddChargeId == 'all')) as $attendee) {
                $this->addChargeToAttendee($attendee->id);
            }
        }

        $this->addChargeToAttendee($this->attendeeToAddChargeId);
    }

    public function updateCharge(): void
    {
        $this->validate([
            'attendeeChargeName' => ['required', 'string', 'max:100'],
            'attendeeChargeNote' => ['nullable', 'string', 'max:1000'],
            'attendeeChargeAmount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'attendeeChargeType' => ['required', 'string', 'in:rated,unrated'],
        ]);

        $attendee = $this->session->attendees->find($this->attendeeToEditChargeId);

        if ($attendee) {

            $chargeListKey = $attendee->attending ? 'charge_list' : 'cancellation_charge_list';

            $chargeList = $attendee->{$chargeListKey};

            $chargeList[$this->attendeeToEditChargeIndex] = [
                'name' => $this->attendeeChargeName,
                'amount' => $this->attendeeChargeAmount,
                'rated' => $this->attendeeChargeType == 'rated',
                'note' => $this->attendeeChargeNote,
                'managed' => false,
            ];


            $attendee->update([
                $chargeListKey => $chargeList
            ]);

            $this->dispatch('close-all-modals');
        }


    }

    public function addChargeToAttendee($attendeeId): void
    {
        $attendee = $this->session->attendees->find($attendeeId);

//        if (!$attendee->attending) {
//            if ($this->attendeeChargeAmount > $this->settings->maximum_session_cancellation_charge_limit) {
//                $this->attendeeChargeAmount = $this->settings->maximum_session_cancellation_charge_limit;
//            }
//        }

        if ($attendee) {

            $chargeListKey = $attendee->attending ? 'charge_list' : 'cancellation_charge_list';

            $chargeList = $attendee->{$chargeListKey};

            $chargeList[] = [
                'name' => $this->attendeeChargeName,
                'amount' => $this->attendeeChargeAmount,
                'rated' => $this->attendeeChargeType == 'rated',
                'note' => $this->attendeeChargeNote,
                'managed' => false,
            ];

            $attendee->update([
                $chargeListKey => $chargeList
            ]);

            $this->resetValidation();
            $this->dispatch('close-all-modals');
        }
    }

    public function resetChargeStudentForm(): void
    {
        $this->attendeeToEditChargeId = '';
        $this->attendeeToAddChargeId = '';
        $this->attendeeChargeName = '';
        $this->attendeeChargeNote = '';
        $this->attendeeChargeAmount = '';
        $this->attendeeChargeType = 'rated';
    }

    public function toggleStudentAttending($attendeeId): void
    {
        $this->removingChargeListAttendeeId = 0;
        $this->removingChargeListIndex = -1;

        $attendee = Attendee::find($attendeeId);

        if ($attendee) {

            $attendee->update([
                'attending' => !$attendee->attending
            ]);

            $this->updateAllAttendeeSessionCharges(false);
        }


    }

    public function toggleStudentCharged($attendeeId): void
    {
        $this->removingChargeListAttendeeId = 0;
        $this->removingChargeListIndex = -1;

        $attendee = Attendee::find($attendeeId);
        if ($attendee) {
            $attendee->update([
                'charged' => !$attendee->charged
            ]);
        }
    }

    public function calculateTotal(): void
    {
        $sum = 0;

        foreach (Attendee::where('session_id', $this->session->id)->where('attending', true)->get() as $attendee) {

            foreach ($attendee->charge_list as $item) {
                if ($item['rated']) {
                    $sum += ($item['amount'] * $this->duration);
                } else {
                    $sum += $item['amount'];
                }
            }
        }

        $this->sessionTotal = $sum;
    }

    public int $removingStudentId = 0;

    public function removeStudent($id): void
    {
        if ($this->removingStudentId == $id) {
            $attendee = $this->session->attendees->where('student_id', '=', $id)->first();

            if ($attendee) {
                $attendee->delete();
                $this->reloadSession();
                $this->updateAllAttendeeSessionCharges(false);
            }
        } else {
            $this->removingStudentId = $id;
        }
    }

    public function reloadSession(): void
    {
        $this->session = Session::find($this->session->id);
    }

    public string $searchStudentQuery = '';
    public $foundStudents;
    public array $selectedStudentIds = [];

    public function addStudent(): void
    {

        if (!$this->session->attendees->whereIn('student_id', $this->selectedStudentIds)->count()) {

            $newAttendeeIds = collect();

            foreach ($this->selectedStudentIds as $studentId) {
                $attendee = Attendee::create([
                    'student_id' => $studentId,
                    'session_id' => $this->session->id,
                    'attending' => true,
                    'charged' => true,
                    'charge_list' => [],
                    'cancellation_charge_list' => [],
                ]);
                $newAttendeeIds->push($attendee->id);
            }

            foreach ($newAttendeeIds as $id) {

                $this->updateAttendeeSessionCharge($id);

            }

            $this->selectedStudentIds = [];
        }

        $this->reloadSession();
        $this->updateAllAttendeeSessionCharges(false);
        $this->dispatch('close-all-modals');
    }

    public function resetAddStudentForm(): void
    {
        $this->selectedStudentIds = [];
        $this->foundStudents = collect();
        $this->searchStudentQuery = '';
    }


    public function removeSelectedStudent($studentId): void
    {
        foreach ($this->selectedStudentIds as $index => $id) {
            if ($id == $studentId) {
                unset($this->selectedStudentIds[$index]);
            }
        }
    }

    public function selectStudent($id): void
    {
        if (!in_array($id, $this->selectedStudentIds)) {
            $this->selectedStudentIds[] = $id;
        }
    }

    public function updatedSearchStudentQuery(): void
    {
        $existingStudentIds = $this->session->attendees->pluck('student_id');
        $search = trim($this->searchStudentQuery);
        $this->foundStudents = Student::where(function ($query) use ($search) {
            $query->whereRaw("concat(trim(first_name), ' ', trim(middle_name), ' ', trim(last_name)) like ?", ["%{$search}%"])
                ->orWhere('primary_phone_number', 'LIKE', '%' . $search . '%')
                ->orWhere('secondary_phone_number', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        })->whereNotIn('id', $existingStudentIds)
            ->limit(5)
            ->orderBy('first_name')
            ->get();
    }


    public function makeTransaction($studentId, $amount, $description): void
    {
        $this->transactionForm->transactable_id = $studentId;
        $this->transactionForm->type = Transaction::TYPE_PURCHASE;
        $this->transactionForm->amount = $amount;
        $this->transactionForm->description = $description;
        $this->transactionForm->store(Student::class);
        $this->transactionForm->model->sync();
    }


    public function completeSession(): void
    {

        $complete = true;

        foreach ($this->session->attendees as $attendee) {

            if ($attendee->charged) {

                $amount = $this->calculateAttendeeChargeList($attendee->id);
                $description = 'Session Purchase ' . $this->session->number . '.';
                if (!$attendee->attending) {
                    $description = 'Session Cancellation ' . $this->session->number . '.';
                }

                if($amount <= 0) {
                    $this->alert('error', 'Student ' . $attendee->student->full_name . ' charge total is zero.');
                    $complete = false;
                } else {
                    $this->makeTransaction($attendee->student_id, $amount, $description);
                }

            } else {
                if($attendee->attending) {
                    $this->makeTransaction($attendee->student_id, 0, 'Free Session ' . $this->session->number . '.');
                }
            }
        }

       if($complete) {
           $this->session->update([
               'total' => $this->sessionTotal,
               'status' => Session::STATUS_COMPLETED,
           ]);

           $this->redirectRoute('dashboard.sessions.show-completed', $this->session->id);
       }

    }

    public function setStatus($action): void
    {
        $this->session->update([
            'status' => $action
        ]);
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $this->calculateTotal();
        $this->reloadSession();
        return view('livewire.dashboard.sessions.manage');
    }

}
