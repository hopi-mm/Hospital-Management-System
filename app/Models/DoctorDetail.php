<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorDetail extends Model
{
    protected $fillable = [
        'user_id',
        'speciality',
        'experience',
        'availability',
        'education',
        'license_number',
    ];

    protected $casts = [
        'speciality'  => 'json',
        'experience'   => 'json',
        'availability' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
