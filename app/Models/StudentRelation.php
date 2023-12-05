<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRelation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'relation_name'
    ];

    const AVAILABLE_RELATIONS = [
        'family' => 'Family',
        'other' => 'Other'
    ];

    public function getRelationNameAttribute(): string
    {
        return self::AVAILABLE_RELATIONS[$this->name];
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function related(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class, 'related_id', 'id');
    }
}
