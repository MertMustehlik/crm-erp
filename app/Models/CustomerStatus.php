<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Customer;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerStatus extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'color',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'color']);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'status_id');
    }
}
