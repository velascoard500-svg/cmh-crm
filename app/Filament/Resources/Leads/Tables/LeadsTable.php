<?php

namespace App\Filament\Resources\Leads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Prospecto')->searchable()->sortable(),
                TextColumn::make('phone')->label('Teléfono')->searchable(),
                TextColumn::make('product')->label('Producto')->badge()->searchable(),
                TextColumn::make('stage')->label('Etapa')->badge()->sortable(),
                TextColumn::make('estimated_amount')->label('Monto')->money('MXN')->sortable(),
                TextColumn::make('next_follow_up')->label('Seguimiento')->date('d/m/Y')->sortable(),
                TextColumn::make('source')->label('Origen')->badge()->toggleable(),
                IconColumn::make('active')->label('Activo')->boolean(),
            ])
            ->filters([
                SelectFilter::make('stage')->label('Etapa')->options([
                    'nuevo' => 'Nuevo',
                    'contactado' => 'Contactado',
                    'medicion' => 'Medición',
                    'cotizacion' => 'Cotización',
                    'negociacion' => 'Negociación',
                    'anticipo' => 'Anticipo',
                    'produccion' => 'Producción',
                    'instalacion' => 'Instalación',
                    'entregado' => 'Entregado',
                    'perdido' => 'Perdido',
                ]),
                SelectFilter::make('product')->label('Producto')->options([
                    'Cocina integral' => 'Cocina integral',
                    'Closet' => 'Closet',
                    'Vestidor' => 'Vestidor',
                    'Puerta' => 'Puerta',
                    'Recepción comercial' => 'Recepción comercial',
                    'Barra para eventos' => 'Barra para eventos',
                    'Barra para snacks' => 'Barra para snacks',
                    'Mueble especial' => 'Mueble especial',
                ]),
            ])
            ->recordActions([
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
