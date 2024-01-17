<?php

namespace App\Livewire\Dashboard\Teachers\Transactions;

use App\Models\Teacher;
use App\Models\Transaction;
use App\Traits\TeacherTransactionModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;


class Index extends Component
{
    use WithPagination, TeacherTransactionModalFunctions;

    public $teacher;
    public array $availableTransactionTypes = [];
    public int $perPage = 10;
    public string $search = '';


    public function mount(Teacher $teacher): void
    {
        $this->teacher = $teacher;
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
            'transferToId' => 'required|integer|exists:teachers,id',
            'transferAmount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'transferDescription' => 'required|string|max:10000',
        ]);

        if($this->teacher->wallet > 0) {

            if($this->transferAmount > $this->teacher->wallet) {

                throw ValidationException::withMessages(['transferAmount' => 'Amount must be less than or equal to current wallet.']);
            }

            $this->form->transfer(Teacher::class, $this->teacher->id, $this->transferToId, $this->transferAmount, $this->transferDescription);
            $this->teacher = Teacher::find($this->teacher->id);
            $this->dispatch('close-all-modals');

        }
    }

    public function store(): void
    {
        $this->form->transactable_id = $this->teacher->id;
        $this->form->store(Teacher::class);
        $this->form->model->sync();

        $this->dispatch('toggle-modal-create');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $transactions = $this->teacher->transactions()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $transactions->where('number', 'LIKE', '%' . trim($this->search) . '%');
        }

        $transactions = $transactions->paginate($this->perPage);

        return view('livewire.dashboard.teachers.transactions.index', [
            'transactions' => $transactions
        ]);
    }

}
