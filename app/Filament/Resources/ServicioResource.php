<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicioResource\Pages;
use App\Filament\Resources\ServicioResource\RelationManagers;
use App\Models\Servicio;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ServicioResource extends Resource
{
    protected static ?string $model = Servicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-asia-australia';

    protected static ?int $navigationSort = 1;
    protected static  ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Formulario Servicio')
            ->schema([
                Forms\Components\Hidden::make('empresa_id')
                    ->default(auth()->user()->empresa_id),
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(100)
                ->live(onBlur: true)
                ->afterStateUpdated(function(string $operation, $state,Forms\Set $set){
                    if ($operation !== 'create') {
                        return ;
                    }
                    $set('slug', Str::slug($state));
                }),
                Forms\Components\TextInput::make('precio')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_visible')
                    ->required(),

            ])->columns(2)
            
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('owner.name')
                        ->sortable()
                        ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->numeric()
                    ->sortable()
                    ->money('CLP', locale: 'es'),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicios::route('/'),
            'create' => Pages\CreateServicio::route('/create'),
            'edit' => Pages\EditServicio::route('/{record}/edit'),
        ];
    }
}
