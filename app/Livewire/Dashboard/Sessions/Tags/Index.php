<?php

namespace App\Livewire\Dashboard\Sessions\Tags;

use App\Models\Session;
use App\Models\SessionTag;
use App\Traits\SessionTagModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, SessionTagModalFunctions;

    public int $perPage = 10;
    public string $search = '';
    public Session $session;

    public function mount(Session $session): void
    {
        $this->session = $session;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $tags = SessionTag::query()->where('session_id', $this->session->id)
            ->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $tags->where('name', 'LIKE', '%' . trim($this->search) . '%');
        }

        $tags = $tags->paginate($this->perPage);

        return view('livewire.dashboard.sessions.tags.index', [
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


        $this->form->session_id = $this->session->id;
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
