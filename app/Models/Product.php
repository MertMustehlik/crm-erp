<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'vat_percent',
        'stock',
        'unit_id',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public static function generateSku($name): string
    {
        do {
            $sku = strtoupper(Str::substr($name, 0, 3)) . '-' . rand(1000, 9999);
        } while (Product::query()->where('sku', $sku)->exists());

        return $sku;
    }
}
