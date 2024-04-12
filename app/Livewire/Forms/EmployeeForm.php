<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Livewire\Form;
use Propaganistas\LaravelPhone\Rules\Phone;

class EmployeeForm extends Form
{

    public $model;

    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $address = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'email' => ['nullable', 'email', 'max:50', 'unique:employees,email' . (!empty($this->model) ? ',' . $this->model->id : '')],
            'phone_number' => ['nullable', 'string', (new Phone)->international()],
            'address' => ['nullable', 'string', 'min:1', 'max:100'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'email' => 'email address',
            'phone_number' => 'phone number',
            'address' => 'address',
        ];
    }

    public function setup($id): void
    {
        $model = Employee::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['name', 'email', 'phone_number', 'address']);
        $data['number'] = Employee::generateNumber();

        $model = new Employee;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only(['name', 'email', 'phone_number', 'address']));
    }

}


