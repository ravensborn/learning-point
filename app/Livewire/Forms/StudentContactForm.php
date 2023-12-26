<?php

namespace App\Livewire\Forms;

use App\Models\StudentContact;
use Livewire\Form;
use Propaganistas\LaravelPhone\Rules\Phone;

class StudentContactForm extends Form
{

    public $model;

    public int $student_id = 0;

    //Variable no longer used.
    public string $countryIso = 'IRQ';

    public string $name = '';
    public string $relation = '';
    public string $primary_phone_number = '';
    public string $secondary_phone_number = '';
    public string $email = '';
    public string $address = '';

    private array $attributes = [
        'student_id',
        'name',
        'relation',
        'primary_phone_number',
        'secondary_phone_number',
        'email',
        'address',
    ];

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'relation' => ['required', 'string', 'in:' . implode(',', array_keys(StudentContact::AVAILABLE_RELATIONS))],
            'primary_phone_number' => ['nullable', 'string', (new Phone)->international()],
            'secondary_phone_number' => ['nullable', 'string', (new Phone)->international()],
            'email' => ['nullable', 'email', 'min:1', 'max:50'],
            'address' => ['nullable', 'string', 'min:1', 'max:100'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'relation' => 'relation',
            'primary_phone_number' => 'primary phone number',
            'secondary_phone_number' => 'secondary phone number',
            'email' => 'email',
            'address' => 'address',
        ];
    }

    public function setup($id, $fill = true): void
    {
        $model = StudentContact::findOrFail($id);

        if($fill) {
            $this->fill($model);
        }

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only($this->attributes);


        $model = new StudentContact();

        return $this->model = $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only($this->attributes));
    }

}


