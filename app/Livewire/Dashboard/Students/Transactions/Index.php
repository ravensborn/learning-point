<?php

namespace App\Livewire\Dashboard\Students\Transactions;

use App\Models\Student;
use App\Models\Transaction;
use App\Traits\TransactionModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

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
