<?php

namespace App\Livewire\Dashboard\Students;

use App\Models\Student;
use App\Traits\StudentModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, StudentModalFunctions;

    public int $perPage = 10;
    public string $search = '';

    public bool $multipleSelectMode = false;
    public array $selectedStudents = [];
    public bool $selectAllStudentsCheckbox = false;

    public function toggleMultipleSelectMode(): void
    {
        $this->multipleSelectMode = !$this->multipleSelectMode;

        if (!$this->multipleSelectMode) {
            $this->bulkActions('clear');
        }
    }

    public function updatedSelectedStudents(): void
    {
        $this->selectAllStudentsCheckbox = $this->isMultipleSelected();
    }

    public function updatedSelectAllStudentsCheckbox(): void
    {
        $this->selectedStudents = $this->selectAllStudentsCheckbox ? Student::query()->select('id')->pluck('id')->toArray() : [];
    }

    public function isMultipleSelected(): bool
    {
        return count($this->selectedStudents) > 0;
    }

    public function getNumberOfSelectedStudents($mode = null): int|string
    {

        $count = count($this->selectedStudents);

        if ($mode == 'with-text') {
            if ($count == 1) {
                return 'Selected ' . $count . ' student';
            }

            return 'Selected ' . $count . ' students';
        }
        return $count;
    }

    public function bulkActions($action): void
    {
        if ($action == 'delete') {
            Student::destroy($this->selectedStudents);
            $this->bulkActions('clear');
        }
        if ($action == 'clear') {
            $this->selectedStudents = [];
            $this->selectAllStudentsCheckbox = false;
            $this->multipleSelectMode = false;
        }
    }

    public function update(): void
    {
        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public string $sort_default_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-numbers" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 6h9" /><path d="M11 12h9" /><path d="M12 18h8" /><path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" /><path d="M6 10v-6l-2 2" /></svg>';
    public string $sort_asc_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-ascending" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l7 0" /><path d="M4 12l7 0" /><path d="M4 18l9 0" /><path d="M15 9l3 -3l3 3" /><path d="M18 6l0 12" /></svg>';
    public string $sort_desc_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-descending" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l9 0" /><path d="M4 12l7 0" /><path d="M4 18l7 0" /><path d="M15 15l3 3l3 -3" /><path d="M18 6l0 12" /></svg>';

    public array $sortedColumns = [
        'first_name' => 'default',
        'created_at' => 'desc',
        'wallet' => 'default'
    ];

    public function getHeaderSortIcon($column): string
    {
        $direction = $this->sortedColumns[$column];

        switch ($direction) {
            case 'default':
                return $this->sort_default_icon;
            case 'asc':
                return $this->sort_asc_icon;
            case 'desc':
                return $this->sort_desc_icon;

        }
    }

    public function sortByColumn($column): void
    {
        $direction = $this->sortedColumns[$column];

        if ($direction == 'default') {
            $this->sortedColumns[$column] = 'asc';
        }

        if ($direction == 'asc') {
            $this->sortedColumns[$column] = 'desc';
        }

        if ($direction == 'desc') {
            $this->sortedColumns[$column] = 'default';
        }

    }

    #[Layout('layouts.app')]
    public function render()
    {
        $students = Student::query();

        if ($this->search) {

            $this->resetPage();

            $students->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->search) . "%' ")
                ->orWhere('primary_phone_number', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhere('secondary_phone_number', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhere('email', 'LIKE', '%' . trim($this->search) . '%');
        }

        if (count($this->sortedColumns) > 0) {
            foreach ($this->sortedColumns as $column => $direction) {
                if ($direction != 'default') {
                    $students->orderBy($column, $direction);
                }
            }
        }

        $students = $students->paginate($this->perPage);

        return view('livewire.dashboard.students.index', [
            'students' => $students
        ]);
    }

}
