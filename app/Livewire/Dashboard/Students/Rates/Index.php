<?php

namespace App\Livewire\Dashboard\Students\Rates;

use App\Models\Group;
use App\Models\Student;
use App\Models\StudentRate;
use App\Models\Subject;
use App\Traits\StudentRateModalFunctions;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, StudentRateModalFunctions;

    public int $perPage = 10;
    public string $search = '';
    public Student $student;

    public $availableSubjects;

    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->availableSubjects = Group::with('subjects')->where('model', Subject::class)->get()->filter(function ($group){
            if($group->subjects->count()) {
                return $group;
            }
        });
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $rates = StudentRate::query()->where('student_id', $this->student->id)
            ->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $rates->where('rate', 'LIKE', '%' . trim($this->search) . '%');
        }

        $rates = $rates->paginate($this->perPage);

        return view('livewire.dashboard.students.rates.index', [
            'rates' => $rates
        ]);
    }


    public function update(): void
    {
        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function store(): void
    {
        if (StudentRate::where('rate', $this->form->rate)
            ->where('number_of_students', $this->form->number_of_students)
            ->where('subject_id', $this->form->subject_id)
            ->first()) {
            throw ValidationException::withMessages(['form.rate' => 'Price rating with the same values already exist.']);
        }

        $this->form->student_id = $this->student->id;
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
