<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Enums\VatPercent;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                TextInput::make('name')
                    ->label('Ürün')
                    ->columnSpan(6)
                    ->required()
                    ->reactive()
                    ->debounce(800)
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state)) {
                            $set('sku', Product::generateSku($state));
                        } else {
                            $set('sku', null);
                        }
                    }),
                TextInput::make('sku')
                    ->label('Kod')
                    ->columnSpan(6)
                    ->unique('products', 'sku')
                    ->required()
                    ->reactive()
                    ->dehydrated()
                    ->disabled(fn(callable $get) => empty($get('name')))
                    ->validationMessages([
                        'unique' => 'Bu kod zaten kullanılıyor.',
                    ]),


                TextInput::make('price')
                    ->label('Fiyat')
                    ->columnSpan(4)
                    ->required()
                    ->reactive()
                    ->prefix('₺')
                    ->afterStateHydrated(fn($set, $get) => $set('price', $get('price') ? number_format($get('price'), 2, ',', '.') : null))
                    ->dehydrateStateUsing(fn($state) => floatval(str_replace(['.', ','], ['', '.'], $state))),
                Select::make('vat_percent')
                    ->label('KDV')
                    ->columnSpan(4)
                    ->required()
                    ->native(false)
                    ->options(VatPercent::options())
                    ->default(VatPercent::TWENTY->value),
                Select::make('unit_id')
                    ->label('Birim')
                    ->columnSpan(4)
                    ->native(false)
                    ->relationship('unit', 'name')
            ]);
    }
}
