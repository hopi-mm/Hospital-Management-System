<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecordType extends Model
{
    protected $fillable=[
        'name',
        'description',
    ];

    public function records(): HasMany
    {
        return $this->hasMany(MedicalRecord::class, 'record_type_id');
    }
}
