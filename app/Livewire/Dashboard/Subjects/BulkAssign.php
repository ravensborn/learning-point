<?php

namespace App\Livewire\Dashboard\Subjects;

use App\Models\Group;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BulkAssign extends Component
{

    use WithPagination;

    public $subjectGroups;
    public $subjects;
    public array $selectedSubjectIds = [];

    public function mount(): void
    {
        $this->subjects = Subject::all();
        $this->subjectGroups = Group::where('model', Subject::class)
            ->has('subjects')
            ->get();
    }

    public function selectSubject($id): void
    {
        $this->selectedSubjectIds[] = $id;
    }

    #[Layout('layouts.app')]
    public function render()
    {


        return view('livewire.dashboard.subjects.bulk-assign');
    }


}
