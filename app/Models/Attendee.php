<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'charge_list'  => 'array',
        'cancellation_charge_list'  => 'array'
    ];

    public function session(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class)->with(['studentRates']);
    }


    public static function calculateStudentCharge($subjectId, $studentRates, $numberOfStudents): array
    {
        $studentPriceException = $studentRates
            ->where('subject_id', $subjectId)
            ->where('number_of_students', $numberOfStudents)
            ->first();

        if ($studentPriceException) {
            return [$studentPriceException->rate, 'Loaded from student price exception table.'];
        }

        $subjectPriceException = Subject::find($subjectId)
            ->subjectRates
            ->where('number_of_students', $numberOfStudents)
            ->first();

        if ($subjectPriceException) {
            return [$subjectPriceException->rate, 'Loaded from subject price table.'];
        }

        return [0, ""];
    }
}
