<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CustomerStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    protected $fillable = [
        'type',
        'company_name',
        'tax_number',
        'tax_office',
        'first_name',
        'last_name',
        'identity_number',
        'email',
        'phone',
        'address',
        'status_id',
        'assigned_user_id',
    ];

    public function casts(): array
    {
        return [
            'type' => CustomerType::class,
        ];
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CustomerStatus::class, 'status_id');
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    /* Attributes */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->type === CustomerType::CORPORATE ? $this->company_name : "{$this->first_name} {$this->last_name}",
        );
    }
}
