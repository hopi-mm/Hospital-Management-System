<?php

namespace App\Models;

use App\Enum\BloodTypeEnum;
use App\Enum\GenderEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'relation',
        'gender',
        'dob',
        'blood_type',
        'phone'
    ];

    protected $casts = [
        'dob' => 'date:Y-m-d',
        'gender' => GenderEnum::class,
        'blood_type' => BloodTypeEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//$table->foreignId('user_id')->constrained()->onDelete('cascade');
//$table->string('name');
//$table->string('relation')->nullable();
//$table->enum('gender',['male','female'])->nullable();
//$table->date('dob')->nullable();
//$table->enum('blood_type',['A+','A-','B+','B-','AB+','AB-','O+','O-'])->nullable();
//$table->integer('phone')->nullable();
}
