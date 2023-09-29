<?php

namespace App\Livewire\Dashboard\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{

    public Collection $users;
    public UserForm $form;

    public function mount(): void
    {
        $this->users = User::all();
    }

    public function store(): void
    {

        $this->form->validate();
        $this->form->store();


//        $this->dispatch('modal-created');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.users.index');
    }
}
