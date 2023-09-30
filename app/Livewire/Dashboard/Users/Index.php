<?php

namespace App\Livewire\Dashboard\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public UserForm $form;

    public int $perPage = 10;
    public string $search = '';

    public function mount(): void
    {

    }

    public User $editableItem;

    public function prepareItemEditing($id): void
    {

        $user = User::findOrFail($id);

        $this->form->setup($user);
        $this->dispatch('modal-edit');
    }

    public int $deletableItemId = 0;

    public function startItemDeletion(): void
    {

        $user = User::findOrFail($this->deletableItemId);
        $user->delete();

        $this->dispatch('modal-delete-confirmation-hide');
    }
    public function resetItemDeletion(): void
    {
        $this->deletableItemId = 0;
        $this->dispatch('closeModals');
    }
    public function prepareItemDeletion($id): void
    {
        $this->deletableItemId = $id;
        $this->dispatch('modal-delete-confirmation');
    }

    public function resetForm(): void
    {
        $this->form->reset();
        $this->dispatch('closeModals');
    }

    public function update(): void
    {

        $this->validateOnly('form.name');
        $this->form->update();
        $this->dispatch('modal-edit');
    }

    public function store(): void
    {
        $this->form->store();
        $this->dispatch('modal-created');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $users = User::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();

            $users->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');

        }

        $users = $users->paginate($this->perPage);

        return view('livewire.dashboard.users.index', [
            'users' => $users
        ]);
    }
}
