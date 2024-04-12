<?php

namespace App\Livewire\Dashboard\Subjects\Rates;

use App\Models\Subject;
use App\Models\SubjectRate;
use App\Traits\SubjectRateModalFunctions;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, SubjectRateModalFunctions;

    public int $perPage = 10;
    public string $search = '';
    public Subject $subject;

    public function mount(Subject $subject): void
    {

        $this->subject = $subject;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $rates = SubjectRate::query()->where('subject_id', $this->subject->id)
            ->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $rates->where('rate', 'LIKE', '%' . trim($this->search) . '%');
        }

        $rates = $rates->paginate($this->perPage);

        return view('livewire.dashboard.subjects.rates.index', [
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
//        if (SubjectRate::where('number_of_students', $this->form->number_of_students)
//            ->where('subject_id', $this->subject->id)
//            ->first()) {
//            throw ValidationException::withMessages(['form.number_of_students' => 'Price rate for the number of students already exists.']);
//        }
//
//        if (SubjectRate::where('rate', $this->form->rate)
//            ->where('number_of_students', $this->form->number_of_students)
//            ->where('subject_id', $this->subject->id)
//            ->first()) {
//            throw ValidationException::withMessages(['form.rate' => 'Price rating with the same values already exist.']);
//        }

        $this->form->subject_id = $this->subject->id;
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
