<?php

namespace App\Models;

use App\Enum\InvoiceStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'mr_id',
        'additional_fee',
        'amount',
        'status',
        'payment_method',
        'due_date',
    ];

    protected $casts = [
        'additional_fee' => 'json',
        'amount' => 'decimal:2',
        'status' => InvoiceStatusEnum::class,
        'due_date' => 'date',
    ];

    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'mr_id',);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id',);
    }
}
