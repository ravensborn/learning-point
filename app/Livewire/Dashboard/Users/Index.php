<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use App\Traits\UserModalFunctions;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, UserModalFunctions;

    public array $roles = [];

    public int $perPage = 12;
    public string $search = '';

    public function mount(): void
    {
        $this->roles = User::roles;
    }
    #[Layout('layouts.app')]
    public function render()
    {
        $users = User::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $users->where('name', 'LIKE', '%' . trim($this->search) . '%')
                ->orWhere('email', 'LIKE', '%' . trim($this->search) . '%');

        }

        $users = $users->paginate($this->perPage);

        return view('livewire.dashboard.users.index', [
            'users' => $users
        ]);
    }

    public function update(): void
    {

        $this->form->update();

        $this->dispatch('toggle-modal-edit');
    }

    public function store(): void
    {
        $this->form->store();

        $this->dispatch('toggle-modal-create');
    }
}
