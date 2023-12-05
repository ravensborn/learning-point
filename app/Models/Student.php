<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Student extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected
        $guarded = ['id'];

    protected
        $casts = [
        'primary_phone_number' => E164PhoneNumberCast::class . ':country',
        'secondary_phone_number' => E164PhoneNumberCast::class . ':country',
        'birthday' => 'date:Y-m-d',
    ];

    protected
        $appends = [
        'full_name',
        'avatar_url',
        'full_address',
        'academic_stream_name'
    ];


    public function getAcademicStreamNameAttribute(): string
    {
        return School::ACADEMIC_STREAMS[$this->academic_stream];
    }

    public
    function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public
    function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public
    function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StudentContact::class);
    }

    public
    function school(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public
    function grade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function relations(): void
    {
        $this->hasMany(StudentRelation::class, 'student_id');
    }

    public
    function hasAvatar(): null|string
    {
        $media = $this->getFirstMedia('avatar');

        return $media?->getUrl();

    }

    public
    function getAvatarUrlAttribute(): string
    {
        return ($media = $this->hasAvatar()) ? $media : asset('images/user.png');
    }

    public
    function getFulLAddressAttribute(): string
    {
        return $this->address . ' - ' . $this->city->name . ' - ' . $this->city->country;
    }

    public function isFemale(): bool
    {
        return $this->gender === 'female';
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Deleted user',
        ]);
    }

}
