<?php

namespace App\Livewire\Dashboard\Students;

use App\Livewire\Forms\StudentContactForm;
use App\Livewire\Forms\StudentForm;
use App\Models\City;
use App\Models\Family;
use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentContact;
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
    public $documents;
    public Collection $transactions;

    public $contacts;
    public $family = null;
    public $familyMembers;
    public $availableFamilies;
    public $availableRelations;
    public $availableAcademicStreams;
    public $availableCities;
    public $availableSchools;
    public $availableGrades;
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

    public function loadDocuments(): array|\Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection
    {
        return $this->documents = Media::where('model_id', $this->student->id)
            ->where('model_type', Student::class)
            ->where('collection_name', 'documents')
            ->orderBy('created_at', 'desc')
            ->get();

    }


    public function loadFamily(): void
    {
        $this->familyMembers = collect();
        $this->family = null;
        if($this->student->family_id) {
            $this->family = Family::find($this->student->family_id);
            $this->familyMembers = $this->family->students;
        }
    }

    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->availableRelations = StudentContact::AVAILABLE_RELATIONS;
        $this->availableAcademicStreams = School::ACADEMIC_STREAMS;
        $this->availableCities = City::all();
        $this->loadContacts();
        $this->availableSchools = School::all();
        $this->availableFamilies = Family::all();

        $this->availableGrades = collect();

        if ($this->student->school_id) {
            $this->availableGrades = Grade::where('school_id', $this->student->school_id)->get();
        }

//        $this->loadDocuments();
        $this->loadFamily();

        $this->transactions = $this->student->transactions()->orderBy('created_at', 'desc')->limit(5)->get();

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.students.show');
    }

}
