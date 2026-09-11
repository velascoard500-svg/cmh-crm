<?php
namespace App\Filament\Resources\Quotes\Tables;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class QuotesTable {
 public static function configure(Table $table): Table { return $table->columns([
  TextColumn::make('folio')->label('Folio')->searchable()->sortable(),
  TextColumn::make('client.name')->label('Cliente')->searchable()->sortable(),
  TextColumn::make('quote_date')->label('Fecha')->date('d/m/Y')->sortable(),
  TextColumn::make('status')->label('Estado')->badge(),
  TextColumn::make('total')->label('Total')->money('MXN')->sortable(),
  TextColumn::make('paid')->label('Pagado')->money('MXN'),
  TextColumn::make('balance')->label('Saldo')->money('MXN'),
  TextColumn::make('delivery_time')->label('Entrega')->toggleable(),
 ])->filters([SelectFilter::make('status')->label('Estado')->options(['borrador'=>'Borrador','enviada'=>'Enviada','aceptada'=>'Aceptada','rechazada'=>'Rechazada','cancelada'=>'Cancelada'])])
 ->recordActions([
            Action::make('pdf')
                ->label('PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn ($record) => route('quotes.pdf', $record))
                ->openUrlInNewTab(),
            ViewAction::make(),
            EditAction::make(),
        ])
 ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])])->defaultSort('created_at','desc'); }
}