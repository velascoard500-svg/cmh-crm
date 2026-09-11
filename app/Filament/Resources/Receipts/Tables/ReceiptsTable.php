<?php

namespace App\Filament\Resources\Receipts\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReceiptsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('folio')->label('Folio')->searchable()->sortable(),
                TextColumn::make('quote.folio')->label('Cotización')->searchable()->sortable(),
                TextColumn::make('quote.client.name')->label('Cliente')->searchable(),
                TextColumn::make('payment_date')->label('Fecha')->date('d/m/Y')->sortable(),
                TextColumn::make('amount')->label('Monto')->money('MXN')->sortable(),
                TextColumn::make('payment_method')->label('Forma de pago')->badge(),
                TextColumn::make('reference')->label('Referencia')->toggleable(),
            ])
            ->filters([
                SelectFilter::make('payment_method')->label('Forma de pago')->options([
                    'transferencia' => 'Transferencia',
                    'efectivo' => 'Efectivo',
                    'tarjeta' => 'Tarjeta',
                    'deposito' => 'Depósito',
                    'otro' => 'Otro',
                ]),
            ])
            ->recordActions([
                Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => route('receipts.pdf', $record))
                    ->openUrlInNewTab(),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}