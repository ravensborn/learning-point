<?php

namespace App\Livewire\Dashboard\Groups;

use App\Models\Expense;
use App\Models\Group;
use App\Models\Subject;
use App\Traits\GroupModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, GroupModalFunctions;


    public int $perPage = 10;
    public string $search = '';
    public string $selectedModelName = 'all';

    public array $availableModels;

    public function mount()
    {

        $this->availableModels = [
            [
                'name' => 'Subject',
                'model' => Subject::class
            ],
            [
                'name' => 'Expense',
                'model' => Expense::class
            ]
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $groups = Group::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $groups->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        if ($this->selectedModelName && $this->selectedModelName != 'all' && collect($this->availableModels)->where('model', $this->selectedModelName)->first()) {

            $this->resetPage();

            $groups->where('model', '=', $this->selectedModelName);
        }

        $groups = $groups->paginate($this->perPage);

        return view('livewire.dashboard.groups.index', [
            'groups' => $groups
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
