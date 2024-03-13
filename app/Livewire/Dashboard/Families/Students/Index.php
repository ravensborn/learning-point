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
    public int $selectedMemberId = 0;

    public function selectSearchedMember($id): void
    {
        $this->selectedMemberId = $id;
        $this->form->student_id = $id;
    }

    public function updatedMemberSearchQuery(): void
    {
        if ($this->memberSearchQuery) {
            $this->searchedMemberList = Student::where('family_id', null)->where(function (Builder $query) {
                $query->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->memberSearchQuery) . "%' ")
                    ->orWhere('primary_phone_number', 'LIKE', '%' . trim($this->memberSearchQuery) . '%')
                    ->orWhere('secondary_phone_number', 'LIKE', '%' . trim($this->memberSearchQuery) . '%')
                    ->orWhere('email', 'LIKE', '%' . trim($this->memberSearchQuery) . '%');
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

            $this->resetPage();
            $students->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->search) . "%' ");

        }

        $students = $students->paginate($this->perPage);

        return view('livewire.dashboard.families.students.index', [
            'students' => $students
        ]);
    }


    public function store(): void
    {
        $this->form->family_id = $this->family->id;
        $this->form->store();
        $this->family = Family::find($this->family->id);

        $this->dispatch('toggle-modal-create');
    }
}
