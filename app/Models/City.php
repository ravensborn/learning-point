<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lwwcas\LaravelCountries\Models\Country;

class City extends Model
{
    use HasFactory;

    const ERBIL = 1;

    public function students(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(Student::class);
    }

}
