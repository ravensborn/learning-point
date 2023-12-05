<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const ACADEMIC_STREAM_OTHER = 'other';
    const ACADEMIC_STREAMS = ['scientific' => 'Scientific', 'literary' => 'Literary', 'other' => 'Other'];

    public
    function students(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Student::class);
    }

    public
    function grades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Grade::class);
    }

}
