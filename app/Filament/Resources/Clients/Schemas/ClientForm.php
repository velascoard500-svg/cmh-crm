<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Datos del cliente')
                ->columns(2)
                ->schema([
                    Select::make('type')->label('Tipo')->options([
                        'persona' => 'Persona',
                        'empresa' => 'Empresa',
                    ])->default('persona')->required(),
                    TextInput::make('name')->label('Nombre')->required()->maxLength(255),
                    TextInput::make('business_name')->label('Empresa / Razón social')->maxLength(255),
                    TextInput::make('phone')->label('Teléfono')->tel()->required()->maxLength(30),
                    TextInput::make('email')->label('Correo')->email()->maxLength(255),
                    Select::make('source')->label('Origen')->options([
                        'Facebook Ads' => 'Facebook Ads',
                        'Instagram' => 'Instagram',
                        'WhatsApp' => 'WhatsApp',
                        'Sitio web' => 'Sitio web',
                        'Google' => 'Google',
                        'Referido' => 'Referido',
                        'Otro' => 'Otro',
                    ]),
                    TextInput::make('city')->label('Ciudad')->maxLength(255),
                    TextInput::make('state')->label('Estado')->maxLength(255),
                    Textarea::make('address')->label('Dirección')->columnSpanFull(),
                    Textarea::make('notes')->label('Notas')->columnSpanFull(),
                    Toggle::make('active')->label('Activo')->default(true),
                ]),
        ]);
    }
}
