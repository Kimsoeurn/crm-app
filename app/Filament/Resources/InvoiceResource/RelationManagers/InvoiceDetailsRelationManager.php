<?php

namespace App\Filament\Resources\InvoiceResource\RelationManagers;

use App\Models\Invoice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'invoiceDetails';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')
                    ->required()
                    ->relationship('service', 'name'),
                Forms\Components\TextInput::make('qty')->numeric()
                    ->required(),
                Forms\Components\TextInput::make('price')->numeric()
                    ->required(),
                Forms\Components\TextInput::make('discount')->numeric(),
                Forms\Components\RichEditor::make('description')
                    ->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.name'),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('price')->money('usd', true),
                Tables\Columns\TextColumn::make('discount'),
                Tables\Columns\TextColumn::make('description'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->after(function (Model $record, $livewire) {
                    $livewire->emit('update-total', $record->invoice->updateTotal());
                }),
                Tables\Actions\Action::make('Print')->action(fn ($livewire) => $livewire->emit('update-total')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->after(function (Model $record, $livewire) {
                    $livewire->emit('update-total', $record->invoice->updateTotal());
                }),
                Tables\Actions\DeleteAction::make()->after(function (Model $record, $livewire) {
                    $livewire->emit('update-total', $record->invoice->updateTotal());
                }),
            ]);
    }
}
