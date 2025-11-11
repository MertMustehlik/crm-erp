<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Enums\CustomerType;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('type')
                            ->label('Müşteri Tipi')
                            ->options(CustomerType::options())
                            ->native(false)
                            ->required()
                            ->default(CustomerType::INDIVIDUAL->value)
                            ->reactive(),
                    ]),

                Section::make('Temel Bilgiler')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Şirket Adı')
                            ->required(fn($get) => $get('type') === CustomerType::CORPORATE->value),

                        TextInput::make('tax_number')
                            ->label('Vergi Numarası'),

                        TextInput::make('tax_office')
                            ->label('Vergi Dairesi'),
                    ])
                    ->visible(fn($get) => $get('type') === CustomerType::CORPORATE->value),

                Section::make('Temel Bilgiler')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Ad')
                            ->required(fn($get) => $get('type') === CustomerType::INDIVIDUAL->value),

                        TextInput::make('last_name')
                            ->label('Soyad')
                            ->required(fn($get) => $get('type') === CustomerType::INDIVIDUAL->value),

                        TextInput::make('identity_number')
                            ->label('TC Kimlik No'),
                    ])
                    ->visible(fn($get) => $get('type') === CustomerType::INDIVIDUAL->value),

                Grid::make(6)
                    ->schema([
                        Section::make('İletişim Bilgileri')
                            ->columnSpan(6)
                            ->schema([
                                TextInput::make('email')
                                    ->label('E-posta')
                                    ->email()
                                    ->unique('customers', 'email')
                                    ->required()
                                    ->validationMessages([
                                        'unique' => 'Bu e-posta adresi zaten kullanılıyor. Eğer silinmiş bir hesapta bu adres kullanılmış ise ve tekrar kullanılmak isteniyor ise yönetici ile iletişime geçiniz.',
                                    ]),
                                PhoneInput::make('phone')
                                    ->label('Telefon')
                                    ->initialCountry('TR'),
                                Textarea::make('address')
                                    ->label('Adres'),
                            ]),
                    ]),

                Grid::make(6)
                    ->schema([
                        Section::make('Diğer')
                            ->columnSpan(6)
                            ->schema([
                                Select::make('status_id')
                                    ->label('Durum')
                                    ->relationship('status', 'name')
                                    ->preload()
                                    ->searchable(),
                                Select::make('assigned_user_id')
                                    ->label('Sorumlu')
                                    ->relationship('assignedUser', 'name')
                                    ->preload()
                                    ->searchable(),
                            ]),
                    ]),
            ]);
    }
}
