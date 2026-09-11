<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Datos del prospecto')
                ->columns(2)
                ->schema([
                    Select::make('client_id')
                        ->label('Cliente vinculado')
                        ->relationship('client', 'name')
                        ->searchable()
                        ->preload(),
                    TextInput::make('name')->label('Nombre')->required()->maxLength(255),
                    TextInput::make('phone')->label('Teléfono')->tel()->required()->maxLength(30),
                    TextInput::make('email')->label('Correo')->email()->maxLength(255),
                    Select::make('product')->label('Producto')->options([
                        'Cocina integral' => 'Cocina integral',
                        'Closet' => 'Closet',
                        'Vestidor' => 'Vestidor',
                        'Puerta' => 'Puerta',
                        'Recepción comercial' => 'Recepción comercial',
                        'Barra para eventos' => 'Barra para eventos',
                        'Barra para snacks' => 'Barra para snacks',
                        'Mueble especial' => 'Mueble especial',
                    ])->required()->searchable(),
                    Select::make('stage')->label('Etapa')->options([
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
                    ])->default('nuevo')->required(),
                    TextInput::make('estimated_amount')->label('Monto estimado')->numeric()->prefix('$')->default(0),
                    Select::make('source')->label('Origen')->options([
                        'Facebook Ads' => 'Facebook Ads',
                        'Instagram' => 'Instagram',
                        'WhatsApp' => 'WhatsApp',
                        'Sitio web' => 'Sitio web',
                        'Google' => 'Google',
                        'Referido' => 'Referido',
                        'Otro' => 'Otro',
                    ]),
                    DatePicker::make('next_follow_up')->label('Próximo seguimiento')->native(false),
                    Textarea::make('notes')->label('Notas')->columnSpanFull(),
                    Toggle::make('active')->label('Activo')->default(true),
                ]),
        ]);
    }
}
