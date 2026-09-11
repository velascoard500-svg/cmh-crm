<?php

namespace App\Filament\Resources\Clients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('business_name')->label('Empresa')->searchable()->toggleable(),
                TextColumn::make('phone')->label('Teléfono')->searchable(),
                TextColumn::make('email')->label('Correo')->searchable()->toggleable(),
                TextColumn::make('source')->label('Origen')->badge(),
                IconColumn::make('active')->label('Activo')->boolean(),
                TextColumn::make('created_at')->label('Alta')->date('d/m/Y')->sortable()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('type')->label('Tipo')->options([
                    'persona' => 'Persona',
                    'empresa' => 'Empresa',
                ]),
                SelectFilter::make('source')->label('Origen')->options([
                    'Facebook Ads' => 'Facebook Ads',
                    'Instagram' => 'Instagram',
                    'WhatsApp' => 'WhatsApp',
                    'Sitio web' => 'Sitio web',
                    'Google' => 'Google',
                    'Referido' => 'Referido',
                    'Otro' => 'Otro',
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
