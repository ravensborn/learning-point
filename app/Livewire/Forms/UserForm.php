<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UserForm extends Form
{

    public string $model = User::class;

    #[Rule('required|min:5')]
    public string $name = '';
    #[Rule('required|string|email|max:50')]
    public string $email = '';
    #[Rule('required|string|max:255')]
    public string $password = '';
    #[Rule('required|string|confirmed:confirmPassword|max:255')]
    public string $confirmPassword = '';

    public function store() {

        $data = $this->only(['name', 'email', 'password']);

        $data['password'] = bcrypt($data['password']);

        $model = new $this->model;

        return $model->create($data);
    }

}
