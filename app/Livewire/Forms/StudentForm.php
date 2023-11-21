<?php

namespace App\Livewire\Forms;

use App\Models\City;
use App\Models\Student;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Propaganistas\LaravelPhone\Rules\Phone;

class StudentForm extends Form
{

    public $model;

    public $avatar;
    public string $avatarUrl = '';

    public string $first_name = '';
    public string $middle_name = '';
    public string $last_name = '';
    public string $gender = 'male';
    public string $birthday = '';
    public string $blood_type = '';
    public string $primary_phone_number = '';
    public string $secondary_phone_number = '';
    public string $email = '';
    public string $country = 'IQ';
    public int $city_id = City::ERBIL;
    public string $address = '';

    private array $attributes = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthday',
        'blood_type',
        'primary_phone_number',
        'secondary_phone_number',
        'email',
        'country',
        'city_id',
        'address'
    ];

    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'mimes:png,jpg', 'max:' . (1024 * 5)],
            'first_name' => ['required', 'string', 'min:1', 'max:50'],
            'middle_name' => ['required', 'string', 'min:1', 'max:50'],
            'last_name' => ['required', 'string', 'min:1', 'max:50'],
            'gender' => ['required', 'string', 'in:male,female'],
            'birthday' => ['required', 'date'],
            'blood_type' => ['required', 'string', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'primary_phone_number' => ['required', 'string', (new Phone)->countryField('country')],
            'secondary_phone_number' => ['nullable', 'string', (new Phone)->countryField('country')],
            'email' => ['nullable', 'string', 'email'],
            'country' => ['required', 'string', 'exists:lc_countries,iso_alpha_2'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'address' => ['nullable', 'string', 'min:1', 'max:100'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'avatar' => 'avatar',
            'first_name' => 'first name',
            'middle_name' => 'middle name',
            'last_name' => 'last name',
            'gender' => 'gender',
            'birthday' => 'birthday',
            'blood_type' => 'blood type',
            'primary_phone_number' => 'primary phone number',
            'secondary_phone_number' => 'secondary phone number',
            'email' => 'e-mail address',
            'country' => 'country',
            'city_id' => 'city',
            'address' => 'address',
        ];
    }

    public function setup($id, $fill = true): void
    {
        $model = Student::findOrFail($id);

        if($fill) {
            $this->fill($model);
        }

        $this->model = $model;
    }

    public function resetProfilePicture(): void
    {
        $this->model->clearMediaCollection('avatar');
    }
    public function setProfilePicture(): void
    {
        if($this->avatar) {

            $this->resetProfilePicture();

            $media = $this->model->addMedia($this->avatar)
                ->usingName('avatar')
                ->usingFileName('avatar' . $this->avatar->getClientOriginalExtension())
                ->toMediaCollection('avatar');

            $this->avatarUrl = $media->getUrl();
            $this->avatar = null;
        }
    }

    public function store()
    {
        $this->validate();

        $data = $this->only($this->attributes);

        $model = new Student();

        return $this->model = $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only($this->attributes));
    }

}


