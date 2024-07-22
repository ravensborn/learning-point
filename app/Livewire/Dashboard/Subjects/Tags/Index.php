<?php

namespace App\Livewire\Dashboard\Subjects\Tags;

use App\Models\Subject;
use App\Models\SubjectTag;
use App\Traits\SubjectTagModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, SubjectTagModalFunctions;

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
        $tags = SubjectTag::query()->where('subject_id', $this->subject->id)
            ->orderBy('name');

        if ($this->search) {

            $this->resetPage();
            $tags->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        $tags = $tags->paginate($this->perPage);

        return view('livewire.dashboard.subjects.tags.index', [
            'tags' => $tags
        ]);
    }


    public function update(): void
    {
        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function store(): void
    {


        $this->form->subject_id = $this->subject->id;
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
