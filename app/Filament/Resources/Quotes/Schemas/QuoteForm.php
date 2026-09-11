<?php
namespace App\Filament\Resources\Quotes\Schemas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
class QuoteForm {
 private static function calc(Get $get, Set $set): void {
  $subtotal=collect($get('items')??[])->sum(fn($i)=>(float)($i['quantity']??0)*(float)($i['unit_price']??0));
  $set('subtotal',round($subtotal,2)); $set('total',round(max(0,$subtotal-(float)($get('discount')??0)),2));
 }
 public static function configure(Schema $schema): Schema { return $schema
            ->columns(1)
            ->components([
  Section::make('Datos de la cotización')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
   Select::make('client_id')->label('Cliente')->relationship('client','name')->searchable()->preload()->required(),
   TextInput::make('folio')->label('Folio')->disabled()->dehydrated(false)->placeholder('Se asigna automáticamente'),
   DatePicker::make('quote_date')->label('Fecha')->default(now())->required(),
   DatePicker::make('valid_until')->label('Vigencia hasta'),
   Select::make('status')->label('Estado')->options(['borrador'=>'Borrador','enviada'=>'Enviada','aceptada'=>'Aceptada','rechazada'=>'Rechazada','cancelada'=>'Cancelada'])->default('borrador')->required(),
   TextInput::make('delivery_time')->label('Tiempo de entrega')->placeholder('Ej. 15 días hábiles'),
   Textarea::make('notes')->label('Notas / condiciones')->columnSpanFull(),
  ]),
  Section::make('Partidas')
                ->columnSpanFull()
                ->schema([
   Repeater::make('items')->label('Conceptos')->relationship()->schema([
    Textarea::make('description')->label('Descripción')->required()->columnSpan(4),
    TextInput::make('quantity')->label('Cantidad')->numeric()->default(1)->required()->live(onBlur:true)->afterStateUpdated(fn(Get $get,Set $set)=>self::calc($get,$set))->columnSpan(2),
    Select::make('unit')->label('Unidad')->options(['pza'=>'Pieza','ml'=>'Metro lineal','m2'=>'m²','servicio'=>'Servicio','lote'=>'Lote'])->default('pza')->required()->columnSpan(2),
    TextInput::make('unit_price')->label('Precio unitario')->numeric()->prefix('$')->default(0)->required()->live(onBlur:true)->afterStateUpdated(fn(Get $get,Set $set)=>self::calc($get,$set))->columnSpan(2),
    TextInput::make('amount')->label('Importe')->numeric()->prefix('$')->disabled()->dehydrated()
                        ->formatStateUsing(fn ($state, Get $get) => round((float) ($get('quantity') ?? 0) * (float) ($get('unit_price') ?? 0), 2))
                        ->columnSpan(2),
   ])->columns(12)
                    ->defaultItems(1)
                    ->addActionLabel('Agregar partida')
                    ->reorderableWithButtons()
                    ->afterStateUpdated(fn(Get $get,Set $set)=>self::calc($get,$set))->columnSpanFull(),
  ]),
  Section::make('Totales')
                ->columnSpanFull()
                ->columns(3)
                ->schema([
   TextInput::make('subtotal')->label('Subtotal')->numeric()->prefix('$')->readOnly()->default(0),
   TextInput::make('discount')->label('Descuento')->numeric()->prefix('$')->default(0)->live(onBlur:true)->afterStateUpdated(fn(Get $get,Set $set)=>self::calc($get,$set)),
   TextInput::make('total')->label('Total')->numeric()->prefix('$')->readOnly()->default(0),
  ]),
 ]); }
}