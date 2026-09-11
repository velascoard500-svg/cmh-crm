<?php

namespace App\Filament\Resources\Receipts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReceiptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Datos del pago')
                    ->columns(2)
                    ->schema([
                        Select::make('quote_id')
                            ->label('Cotización')
                            ->relationship('quote', 'folio')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('folio')
                            ->label('Folio')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Se asigna automáticamente'),
                        DatePicker::make('payment_date')
                            ->label('Fecha de pago')
                            ->default(now())
                            ->required(),
                        TextInput::make('amount')
                            ->label('Monto')
                            ->numeric()
                            ->prefix('$')
                            ->required(),
                        Select::make('payment_method')
                            ->label('Forma de pago')
                            ->options([
                                'transferencia' => 'Transferencia',
                                'efectivo' => 'Efectivo',
                                'tarjeta' => 'Tarjeta',
                                'deposito' => 'Depósito',
                                'otro' => 'Otro',
                            ])
                            ->default('transferencia')
                            ->required(),
                        TextInput::make('reference')
                            ->label('Referencia / comprobante')
                            ->maxLength(255),
                        Textarea::make('notes')
                            ->label('Notas')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}