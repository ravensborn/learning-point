<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchool extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

  protected $appends = [
      'academic_stream_name'
  ];

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function getAcademicStreamNameAttribute(): string
    {
        return Student::ACADEMIC_STREAMS[$this->academic_stream];
    }
}
