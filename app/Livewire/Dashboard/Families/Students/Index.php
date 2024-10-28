<?php

namespace App\Livewire\Dashboard\Families\Students;

use App\Models\Family;
use App\Models\Student;
use App\Traits\FamilyStudentModalFunctions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, FamilyStudentModalFunctions;

    public int $perPage = 10;
    public string $search = '';
    public Family $family;


    public string $memberSearchQuery = '';
    public Collection $searchedMemberList;
    public array $selectedMemberIds = [];

    public function selectSearchedMember($id): void
    {
        if (!in_array($id, $this->selectedMemberIds)) {
            $this->selectedMemberIds[] = $id;
        } else {
            $this->selectedMemberIds = array_diff($this->selectedMemberIds, [$id]);
        }
    }

    public function updatedMemberSearchQuery(): void
    {
        if ($this->memberSearchQuery) {
            $this->searchedMemberList = Student::where('family_id', null)->where(function (Builder $query) {
                $search = trim($this->memberSearchQuery);
                $query->whereRaw("concat(trim(first_name), ' ', trim(middle_name), ' ', trim(last_name)) like ?", ["%{$search}%"])
                    ->orWhere('primary_phone_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('secondary_phone_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search. '%');
            })->limit(10)->get();
        } else {
            $this->searchedMemberList = collect();
        }
    }

    public function mount(Family $family): void
    {

        $this->family = $family;
        $this->searchedMemberList = collect();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $students = Student::query()->where('family_id', $this->family->id)
            ->orderBy('created_at', 'desc');

        if ($this->search) {

            $search = trim($this->search);

            $this->resetPage();
            $students->whereRaw("concat(trim(first_name), ' ', trim(middle_name), ' ', trim(last_name)) like ?", ["%{$search}%"]);

        }

        $students = $students->paginate($this->perPage);

        return view('livewire.dashboard.families.students.index', [
            'students' => $students
        ]);
    }


    public function store(): void
    {
        $this->form->family_id = $this->family->id;
        foreach ($this->selectedMemberIds as $studentId) {

            $this->form->student_id = $studentId;
            $this->form->store();
        }

        $this->family = Family::find($this->family->id);

        $this->dispatch('toggle-modal-create');
    }
}
