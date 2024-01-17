<?php

namespace App\Livewire\Dashboard\Employees;

use App\Models\Employee;
use App\Traits\EmployeeModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, EmployeeModalFunctions;

    public int $perPage = 10;
    public string $search = '';

    public function mount()
    {


    }

    #[Layout('layouts.app')]
    public function render()
    {
        $employees = Employee::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $employees->where('name', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhere('email', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhere('phone_number', 'LIKE', '%' . trim($this->search) . '%');
        }

        $employees = $employees->paginate($this->perPage);

        return view('livewire.dashboard.employees.index', [
            'employees' => $employees
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
