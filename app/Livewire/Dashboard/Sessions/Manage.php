<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Livewire\Forms\SessionForm;
use App\Livewire\Forms\TransactionForm;
use App\Models\Attendee;
use App\Models\Group;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Manage extends Component
{

    public TransactionForm $transactionForm;
    public $session;

    public string $total = '';

    public float $duration = 0;


    public function mount(Session $session): void
    {
        $this->session = $session;
        $this->duration = $session->time_out->floatDiffInRealHours($session->time_in);
        $this->foundStudents = collect();
        $this->calculateTotal();
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

        if ($attendee) {

            $chargeListKey = $attendee->attending ? 'charge_list' : 'cancellation_charge_list';

            $chargeList = $attendee->{$chargeListKey};

            $chargeList[] = [
                'name' => $this->attendeeChargeName,
                'amount' => $this->attendeeChargeAmount,
                'rated' => $this->attendeeChargeType == 'rated',
                'note' => $this->attendeeChargeNote,
            ];

            $attendee->update([
                $chargeListKey => $chargeList
            ]);

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
        foreach ($this->session->attendees as $attendee) {
            foreach ($attendee->charge_list as $item) {
                $sum += $item['amount'];
            }
        }

        $this->total = $sum;
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
    public int $selectedStudentId = 0;

    public function addStudent(): void
    {
        if (!$this->session->attendees->find($this->selectedStudentId)) {
            Attendee::create([
                'student_id' => $this->selectedStudentId,
                'session_id' => $this->session->id,
                'cancelled' => false,
                'charge_list' => [],
            ]);
        }

        $this->dispatch('close-all-modals');
    }

    public function resetAddStudentForm(): void
    {
        $this->selectedStudentId = 0;
        $this->foundStudents = collect();
        $this->searchStudentQuery = '';
    }

    public function selectStudent($id): void
    {
        $this->selectedStudentId = $id;
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


    public function makeTransaction($studentId, $amount): void
    {
        $this->transactionForm->transactable_id = $studentId;
        $this->transactionForm->type = Transaction::TYPE_PURCHASE;
        $this->transactionForm->amount = $amount;
        $this->transactionForm->description = 'Session Purchase - ' . $this->session->id;
        $this->transactionForm->store(Student::class);
        $this->transactionForm->model->sync();

        $this->session->update([
            'status' => Session::STATUS_COMPLETED,
        ]);
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.sessions.manage');
    }

}
