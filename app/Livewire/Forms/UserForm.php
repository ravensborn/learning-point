<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule as VRule;
use Livewire\Form;

class UserForm extends Form
{

    public $model;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', VRule::unique('users', 'email')->ignore($this->model?->id ?? 0)],
            'password' => ['sometimes', 'string', 'confirmed', 'max:50'],
            'password_confirmation' => ['sometimes', 'string', 'max:50'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'password_confirmation' => 'password confirmation'
        ];
    }

    public function setup($id): void
    {
        $model = User::findOrFail($id);

        $this->name = $model->name;
        $this->email = $model->email;

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['name', 'email', 'password']);

        $data['password'] = bcrypt($data['password']);

        $model = new User;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('name', 'email'));
    }

}


