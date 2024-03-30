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

    public bool $dateFiltering = false;
    public $dateTo;
    public $dateFrom;
    public array $expenseStats;

    public function toggleDateFiltering(): void
    {
        $this->dateFiltering = !$this->dateFiltering;
    }

    public function loadExpenseStats(): void
    {

        $total = 0;

        foreach ($this->groups as $group) {

            $amount = $group->expenses->sum('amount');

            $this->expenseStats[] = [
                'name' => $group->name,
                'amount' => $amount,
            ];

            $total += $amount;
        }

        $this->expenseStats[] = [
            'name' =>  'Total',
            'amount' => $total,
        ];
    }

    public function mount(): void
    {

        $this->groups = Group::where('model', Expense::class)
            ->orderBy('created_at', 'desc')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $expenses = Expense::query()->orderBy('created_at', 'desc');

        if ($this->dateFiltering && ($this->dateTo && $this->dateFrom)) {
            $expenses->whereBetween('created_at', [
                $this->dateFrom,
                $this->dateTo
            ]);
        }
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
