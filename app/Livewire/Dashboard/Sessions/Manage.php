<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Livewire\Forms\TransactionForm;
use App\Models\Attendee;
use App\Models\Session;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Manage extends Component
{
    public TransactionForm $transactionForm;
    public $session;

    public float $duration = 0;

    public $settings;

    public float $sessionTotal = 0;

    public function mount(Session $session): void
    {
        if ($session->status == Session::STATUS_COMPLETED) {
            $this->redirectRoute('dashboard.sessions.show-completed', $session->id);
        }

        $this->session = $session;
        $this->duration = round($session->time_out->floatDiffInRealHours($session->time_in), 2);
        $this->foundStudents = collect();
        $this->settings = Setting::find(1);
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

    public function updateAllAttendeeSessionCharges($createIfNotExist): void
    {
        foreach ($this->session->attendees as $attendee) {
            $this->session->updateAttendeeSessionCharge($attendee->id, $createIfNotExist);
        }
        $this->reloadSession();
    }

    public function updateAttendeeSessionCharge($attendeeId): void
    {
        $this->session->updateAttendeeSessionCharge($attendeeId);
        $this->reloadSession();
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
            $this->reloadSession();
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
            $this->reloadSession();
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

            //TODO: FIX THIS
//            $this->session->updateAttendeeSessionCharge($attendeeId);

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
        foreach ($this->session->attendees->where('attending', true) as $attendee) {
            foreach ($attendee->charge_list as $item) {
                if ($item['rated']) {
                    $sum += $item['amount'] * $this->duration;
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

            if ($id) {
                $attendee->delete();
                $this->reloadSession();
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

            $this->reloadSession();

            foreach ($newAttendeeIds as $id) {
                $this->session->updateAttendeeSessionCharge($id);
            }

            $this->selectedStudentIds = [];
        }
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

        $this->foundStudents = Student::where(function ($query) {
            $query->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->searchStudentQuery) . "%' ")
                ->orWhere('primary_phone_number', 'LIKE', '%' . trim($this->searchStudentQuery) . '%')
                ->orWhere('secondary_phone_number', 'LIKE', '%' . trim($this->searchStudentQuery) . '%')
                ->orWhere('email', 'LIKE', '%' . trim($this->searchStudentQuery) . '%');
        })->whereNotIn('id', $existingStudentIds)
            ->limit(5)
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

        foreach ($this->session->attendees as $attendee) {

            if ($attendee->charged) {

                $amount = $this->calculateAttendeeChargeList($attendee->id);
                $description = 'Session Purchase ' . $this->session->number . '.';
                if (!$attendee->attending) {
                    $description = 'Session Cancellation ' . $this->session->number . '.';
                }

                if ($amount > 0) {
                    $this->makeTransaction($attendee->student_id, $amount, $description);
                }

            } else {
                $this->makeTransaction($attendee->student_id, 0, 'Free Session ' . $this->session->number . '.');
            }


        }

        $this->session->update([
            'total' => $this->sessionTotal,
            'status' => Session::STATUS_COMPLETED,
        ]);

        $this->redirectRoute('dashboard.sessions.show-completed', $this->session->id);

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
        return view('livewire.dashboard.sessions.manage');
    }

}
