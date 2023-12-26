<?php

namespace App\Livewire\Forms;

use App\Models\City;
use App\Models\School;
use App\Models\Student;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Propaganistas\LaravelPhone\Rules\Phone;

class StudentForm extends Form
{

    public $model;

    public $user_id;

    public $avatar;
    public string $avatarUrl = '';

    public string $first_name = '';
    public string $middle_name = '';
    public string $last_name = '';

    public int|null $family_id = null;
    public int|null $school_id = null;
    public int|null $grade_id = null;

    public string|null $academic_stream = School::ACADEMIC_STREAM_OTHER;
    public string|null $school_username = null;
    public string|null $school_password = null;

    public string $gender = 'male';
    public string|null $birthday = null;
    public string|null $blood_type = null;
    public string|null $primary_phone_number = null;
    public string|null $secondary_phone_number = null;
    public string|null $email = '';
    public string $country = 'IQ';
    public int $city_id = City::ERBIL;
    public string|null $address = '';

    private array $attributes = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'family_id',
        'school_id',
        'grade_id',
        'academic_stream',
        'school_username',
        'school_password',
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
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'avatar' => ['nullable', 'mimes:png,jpg', 'max:' . (1024 * 5)],
            'first_name' => ['required', 'string', 'min:1', 'max:50'],
            'middle_name' => ['required', 'string', 'min:1', 'max:50'],
            'last_name' => ['required', 'string', 'min:1', 'max:50'],
//            'family_id' => ['nullable', 'integer', 'exists:families,id'],
//            'school_id' => ['nullable', 'integer', 'exists:schools,id'],
//            'grade_id' => ['sometimes', 'integer', 'exists:grades,id'],
//            'academic_stream' => ['sometimes', 'string', 'in:' . implode(',', array_keys(School::ACADEMIC_STREAMS))],
//            'school_username' => ['sometimes', 'string', 'min:1', 'max:50'],
//            'school_password' => ['sometimes', 'string', 'min:1', 'max:50'],
            'gender' => ['required', 'string', 'in:male,female'],
            'birthday' => ['nullable', 'date'],
            'blood_type' => ['nullable', 'string', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'primary_phone_number' => ['nullable', 'string', (new Phone)->international()],
            'secondary_phone_number' => ['nullable', 'string', (new Phone)->international()],
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'country' => ['required', 'string', 'exists:lc_countries,iso_alpha_2'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'address' => ['nullable', 'string', 'min:1', 'max:100'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'user_id' => 'user',
            'avatar' => 'avatar',
            'first_name' => 'first name',
            'middle_name' => 'middle name',
            'last_name' => 'last name',
            'family_id' => 'family',
            'school_id' => 'school',
            'grade_id' => 'grade',
            'academic_stream' => 'academic stream',
            'school_username' => 'school username',
            'school_password' => 'school password',
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

        if ($fill) {
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
        if ($this->avatar) {

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


