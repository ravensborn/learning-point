<?php

namespace App\Livewire\Dashboard\Subjects\Rates;

use App\Livewire\Forms\SubjectRateForm;
use App\Models\Group;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BulkAssign extends Component
{

    use WithPagination;

    public SubjectRateForm $subjectRateForm;
    public bool $success = false;
    public $subjectGroups;
    public $subjects;
    public array $selectedSubjectIds = [];

    public array $ratings = [];
    public string $rate = "0";
    public string $numberOfStudents = "1";

    public array $overlappedRatingSubjects = [];

    public function mount(): void
    {
        $this->subjects = Subject::orderBy('name')->get();
        $this->subjectGroups = Group::where('model', Subject::class)
            ->has('subjects')
            ->orderBy('name')
            ->get();
    }

    public function selectSubject($id): void
    {
        if (!in_array($id, $this->selectedSubjectIds)) {
            $this->selectedSubjectIds[] = $id;
        } else {
            $this->selectedSubjectIds = array_diff($this->selectedSubjectIds, [$id]);
        }
    }

    public function addRate(): void
    {
        $this->validate([
            'rate' => 'required|numeric|gt:0',
            'numberOfStudents' => 'required|integer|gt:0',
        ]);

        if ($this->hasExistingNumberOfStudents($this->numberOfStudents)) {
            $this->addError('numberOfStudents', 'Rating is already assigned for the selected number of students.');
        } else {
            $this->resetErrorBag('numberOfStudents');
            $this->ratings[] = [
                'numberOfStudents' => $this->numberOfStudents,
                'rate' => $this->rate,
            ];
            $this->numberOfStudents = 1;
            $this->rate = 0;
        }
    }

    public function validateRatings(): void
    {

        $this->overlappedRatingSubjects = [];

        foreach ($this->selectedSubjectIds as $selectedSubjectId) {
            $subject = $this->subjects->find($selectedSubjectId);
            foreach ($subject->subjectRates as $subjectRate) {
                if ($this->hasExistingNumberOfStudents($subjectRate->number_of_students)) {
                    $this->overlappedRatingSubjects[] = [
                        'id' => $selectedSubjectId,
                        'name' => $subject->name,
                        'group' => $subject->group->name,
                    ];
                    break;
                }
            }
        }
    }

    public function assignRatings(): void
    {
        foreach ($this->selectedSubjectIds as $selectedSubjectId) {
            foreach ($this->ratings as $rating) {
                $this->subjectRateForm->subject_id = $selectedSubjectId;
                $this->subjectRateForm->rate = $rating['rate'];
                $this->subjectRateForm->number_of_students = $rating['numberOfStudents'];
                $this->subjectRateForm->store();
            }
        }

        $this->selectedSubjectIds = [];
        $this->ratings = [];
        $this->overlappedRatingSubjects = [];
        $this->rate = "0";
        $this->numberOfStudents = "1";
        $this->success = true;
    }

    public function removeRating($key): void
    {
        if (array_key_exists($key, $this->ratings)) {
            unset($this->ratings[$key]);
        }
    }

    public function refreshOverlaps(): void
    {
        $this->validateRatings();
    }

    public function hasExistingNumberOfStudents($numberOfStudents): bool
    {
        return !empty(array_filter($this->ratings, function ($rating) use ($numberOfStudents) {
            return $rating['numberOfStudents'] == $numberOfStudents;
        }));
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $this->validateRatings();
        return view('livewire.dashboard.subjects.rates.bulk-assign');
    }


}
