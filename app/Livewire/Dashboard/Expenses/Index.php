<?php

namespace App\Livewire\Dashboard\Expenses;

use App\Models\Expense;
use App\Models\Group;
use App\Traits\ExpenseModalFunctions;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, ExpenseModalFunctions;


    public int $perPage = 10;
    public string $search = '';

    public Collection $groups;

    public function mount() {

        $this->groups = Group::where('model', Expense::class)
            ->orderBy('created_at', 'desc')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $expenses = Expense::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $expenses->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        $expenses = $expenses->paginate($this->perPage);

            return view('livewire.dashboard.expenses.index', [
                'expenses' => $expenses
            ]);
    }


    public function update(): void
    {

        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function store(): void
    {
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
