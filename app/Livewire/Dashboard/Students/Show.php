<?php

namespace App\Livewire\Dashboard\Students;

use App\Livewire\Forms\StudentContactForm;
use App\Livewire\Forms\StudentForm;
use App\Livewire\Forms\StudentRelationForm;
use App\Models\City;
use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentContact;
use App\Models\StudentRelation;
use App\Traits\StudentShowModalFunctions;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Show extends Component
{

    use WithFileUploads, StudentShowModalFunctions;

    public Student $student;
    public StudentForm $studentForm;
    public StudentContactForm $studentContactForm;
    public StudentRelationForm $studentRelationForm;
    public $documents;
    public Collection $transactions;

    public $contacts;
    public $availableRelations;
    public $availableAcademicStreams;
    public $availableCities;
    public $availableSchools;
    public $availableGrades;
    public $availableStudentRelations;
    public $availableStudentRelationTypes;


    public bool $showStudentSchoolAccountPassword = false;

    public $selectedContact;

    public bool $updateAvatarMode = false;


    public function toggleStudentSchoolAccountPassword(): void
    {
        $this->showStudentSchoolAccountPassword = !$this->showStudentSchoolAccountPassword;
    }


    public function loadContacts(): void
    {
        $this->contacts = StudentContact::where('student_id', $this->student->id)->get();
    }

    public function reloadStudent(): void
    {
        $this->student = Student::findOrFail($this->student->id);
    }

    public function updatedStudentFormSchoolId(): void
    {
        if (isset($this->studentForm->school_id) && $this->studentForm->school_id) {
            $this->availableGrades = Grade::where('school_id', $this->studentForm->school_id)->get();
            $this->studentForm->grade_id = 0;
        }
    }

    public function loadStudentRelations(): void
    {
        $this->availableStudentRelations = StudentRelation::where('student_id', $this->student->id)->get();
    }


    public function loadDocuments(): void
    {
        $this->documents = Media::where('model_id', $this->student->id)
            ->where('model_type', Student::class)
            ->where('collection_name', 'documents')
            ->get();
    }

    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->availableRelations = StudentContact::AVAILABLE_RELATIONS;
        $this->availableAcademicStreams = School::ACADEMIC_STREAMS;
        $this->availableCities = City::all();
        $this->loadContacts();
        $this->availableSchools = School::all();

        $this->availableGrades = collect();

        if ($this->student->school_id) {
            $this->availableGrades = Grade::where('school_id', $this->student->school_id)->get();
        }

        $this->loadStudentRelations();
        $this->availableStudentRelationTypes = StudentRelation::AVAILABLE_RELATIONS;
        $this->searchedStudentRelationsStudents = collect();
        $this->loadDocuments();

        $this->transactions = $this->student->transactions()->orderBy('created_at', 'desc')->limit(5)->get();

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.students.show');
    }

}
