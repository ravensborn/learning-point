<?php

namespace App\Livewire\Dashboard\Transactions;

use App\Models\Student;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PrintTransaction extends Component
{

    public $transaction;

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';

    public float $wallet;


    public function mount(Transaction $transaction): void
    {
        $this->transaction = $transaction;

        if($transaction->transactable_type == Student::class) {

            $student = $transaction->transactable;

            $this->name = $student->full_name;
            $this->email = $student->email ?? '';
            $this->phone = $student->primary_phone_number ?? '';
            $this->address = $student->address ?? '';

            $this->wallet = (float) $student->wallet;
        }
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.transactions.print-transaction');
    }

}
