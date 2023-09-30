<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Validator;

class UserForm extends Form
{

    public string|User $model = User::class;

    #[Rule('required|string|min:3|max:50')]
    public string $name = '';
    #[Rule('required|string|email|max:50|unique:users,email')]
    public string $email = '';
    #[Rule('required|string|confirmed|max:50')]
    public string $password = '';
    #[Rule('required|string|max:50')]
    public string $password_confirmation = '';

    public function setup($model): void
    {
        $this->model = $model;
        $this->fill($model);
    }
    public function store() {

        $this->validate();

        $data = $this->only(['name', 'email', 'password']);

        $data['password'] = bcrypt($data['password']);

        $model = new $this->model;

        return $model->create($data);
    }

    public function update()
    {
        return $this->model->update($this->only('name'));
    }

}
