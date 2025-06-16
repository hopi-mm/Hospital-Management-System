<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalRecord extends Model
{
    protected $fillable = [
        'appointment_id',
        'record_type_id',
        'title',
        'description',
        'total_medicine_price',
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function recordType(): BelongsTo
    {
        return $this->belongsTo(RecordType::class);
    }

    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class,  'mr_medicines',  'mr_id', 'medicine_id')
                    ->withPivot('quantity')
                    ->withTimestamps();;
    }
}
