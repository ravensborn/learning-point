<?php

namespace App\Livewire\Dashboard\Students\Transactions;

use App\Models\Student;
use App\Models\Transaction;
use App\Traits\TransactionModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;


class Index extends Component
{
    use WithPagination, TransactionModalFunctions;

    public $student;
    public array $availableTransactionTypes = [];
    public int $perPage = 10;
    public string $search = '';


    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->availableTransactionTypes = Transaction::TYPES;
        $this->transferToList = collect();
    }


    public function update(): void
    {
        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function transfer(): void
    {
        $this->validate([
            'transferToId' => 'required|integer|exists:students,id',
            'transferAmount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'transferDescription' => 'required|string|max:10000',
        ]);

        if($this->student->wallet > 0) {

            if($this->transferAmount > $this->student->wallet) {

                throw ValidationException::withMessages(['transferAmount' => 'Amount must be less than or equal to current wallet.']);
            }

            $this->form->transfer($this->student->id, $this->transferToId, $this->transferAmount, $this->transferDescription);
            $this->student = Student::find($this->student->id);
            $this->dispatch('close-all-modals');

        }
    }

    public function store(): void
    {
        $this->form->transactable_id = $this->student->id;
        $this->form->store();
        $this->form->model->sync();

        $this->dispatch('toggle-modal-create');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $transactions = $this->student->transactions()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $transactions->where('number', 'LIKE', '%' . trim($this->search) . '%');
        }

        $transactions = $transactions->paginate($this->perPage);

        return view('livewire.dashboard.students.transactions.index', [
            'transactions' => $transactions
        ]);
    }

}
