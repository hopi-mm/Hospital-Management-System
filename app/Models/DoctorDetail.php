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
        'education',
        'license_number',
    ];

    protected $casts = [
        'speciality'  => 'json',
        'experience'   => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//$table->foreignId('user_id')->constrained()->onDelete('cascade');
//$table->json('speciality')->nullable();
//$table->json('experience')->nullable();
//$table->string('education')->nullable();
//$table->string('license_number')->nullable();
}
