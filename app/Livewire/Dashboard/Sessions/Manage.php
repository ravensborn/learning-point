<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Livewire\Forms\SessionForm;
use App\Livewire\Forms\TransactionForm;
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

    public bool $proceedToComplete = false;
    public bool $proceedToCancel = false;

    public function mount(Session $session): void
    {
        $this->session = $session;
        $this->calculateTotal();
    }


    public string $student_id = '';
    public string $description = '';
    public string $amount = '';
    public string $note = '';

    public function calculateTotal(): void
    {
        $sum = 0;
        foreach ($this->session->students as $student) {
            foreach ($student['charge_list'] as $item) {
                $sum += $item['amount'];
            }
        }

        $this->total = $sum;
    }

    public function storeChargeItem(): void
    {

        $validated = $this->validate([
            'student_id' => 'required|integer|exists:students,id',
            'description' => 'required|string|max:50',
            'amount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'note' => 'nullable|string|max:1000',
        ]);

        $students = $this->session->students;
        $chargeList = $students[$validated['student_id']]['charge_list'];
        $chargeList[] = [
            'name' => $validated['description'],
            'amount' => $validated['amount'],
            'note' => $validated['note'],
        ];

        $students[$validated['student_id']]['charge_list'] = $chargeList;
        $this->session->students = $students;
        $this->session->save();
        $this->calculateTotal();

        $this->dispatch('close-all-modals');
    }

    public function cancel(): void
    {

        $this->proceedToComplete = false;

        if ($this->proceedToCancel) {

            foreach ($this->session->students as $studentId => $student) {

                $this->makeSessionCancelTransaction($studentId);
            }

        } else {
            $this->proceedToCancel = true;
        }

    }

    public function makeSessionCancelTransaction($studentId): void
    {
        $this->transactionForm->transactable_id = $studentId;
        $this->transactionForm->type = Transaction::TYPE_PURCHASE;
        $this->transactionForm->amount = 50;
        $this->transactionForm->description = 'Session Cancellation Fee - ' . $this->session->id;
        $this->transactionForm->store(Student::class);
        $this->transactionForm->model->sync();

        $this->session->update([
            'status' => Session::STATUS_CANCELLED,
        ]);
    }

    public function complete(): void
    {

        $this->proceedToCancel = false;

        if ($this->proceedToComplete) {
            foreach ($this->session->students as $studentId => $student) {

                $studentSum = 0;

                foreach ($student['charge_list'] as $item) {

                    $studentSum += $item['amount'];
                }

                if ($studentSum > 0) {
                    $this->makeTransaction($studentId, $studentSum);
                }
            }
        } else {
            $this->proceedToComplete = true;
        }

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

    public function resetForm(): void
    {
        $this->student_id = '';
        $this->description = '';
        $this->amount = '';
        $this->resetValidation();
    }

    public function removeItem($studentId, $chargeListIndex): void
    {
        $students = $this->session->students;
        unset($students[$studentId]['charge_list'][$chargeListIndex]);
        $this->session->students = $students;
        $this->calculateTotal();
        $this->session->save();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.sessions.manage');
    }

}
