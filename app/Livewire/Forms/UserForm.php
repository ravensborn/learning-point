<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule as VRule;
use Livewire\Form;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class UserForm extends Form
{

    public $model;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $gender = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', VRule::unique('users', 'email')->ignore($this->model?->id ?? 0)],
            'gender' => ['required', 'string', 'in:male,female'],
            'password' => ['sometimes', 'string', 'confirmed', 'max:50'],
            'password_confirmation' => ['sometimes', 'string', 'max:50'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'email' => 'email',
            'gender' => 'gender',
            'password' => 'password',
            'password_confirmation' => 'password confirmation',
        ];
    }

    public function setup($id): void
    {
        $model = User::findOrFail($id);

        $this->name = $model->name;
        $this->email = $model->email;
        $this->gender = $model->gender;

        $this->model = $model;
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store()
    {
        $this->validate();

        $data = $this->only(['name', 'email', 'gender', 'password']);

        $data['password'] = bcrypt($data['password']);
        $data['user_id'] = auth()->user()->id;

        $model = new User;

        $model = $model->create($data);

        $avatars = $model::getAvatarsArray($model->gender);

        $model->addMedia($avatars[array_rand($avatars)])
            ->preservingOriginal()
            ->toMediaCollection('avatar');

        $model->assignRole('system user');

        return $model;
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('name', 'email'));
    }

}


