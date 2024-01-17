<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transactions(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactable');
    }
}
