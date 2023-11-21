<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'relation_name'
    ];

    const AVAILABLE_RELATIONS = [
        'father' => 'Father',
        'mother' => 'Mother',
        'brother' => 'Brother',
        'sister' => 'Sister',
        'cousin' => 'Cousin',
        'grandfather' => 'Grandfather',
        'grandmother' => 'Grandmother',
        'uncle' => 'Uncle',
        'aunt' => 'Aunt',
        'nephew' => 'Nephew',
        'niece' => 'Niece',
    ];

    public function getRelationNameAttribute(): string
    {
        return self::AVAILABLE_RELATIONS[$this->relation];
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
