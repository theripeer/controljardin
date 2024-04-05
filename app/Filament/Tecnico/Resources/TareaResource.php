<?php

namespace App\Filament\Tecnico\Resources;

use App\Filament\Tecnico\Resources\TareaResource\Pages;
use App\Filament\Tecnico\Resources\TareaResource\RelationManagers;
use App\Models\Tarea;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TareaResource extends Resource
{
    protected static ?string $model = Tarea::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): ?string
    {
        return __('Tarea');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //TextInput::make('empresa_id'),
                Forms\Components\Select::make('empresa_id')
                ->relationship('owner', 'name')
                ->required(),
                //->searchable(),
                Forms\Components\Select::make('tecnico_id')
                ->relationship('tecnico', 'name')
                ->required(),
                //->searchable(),
                TextInput::make('name')
                ->autofocus()
                ->required()
                ->minLength(2)
                ->maxLength(150)
                ->placeholder(__('Nombre')),
                ColorPicker::make('color')
                ->required()
                ->placeholder(__('color')),
                FileUpload::make('image1')
                ->label(__('Imagen 1'))
                ->image()
                ->directory('tareas')

                //->imagen()->preserveFilenames()
                //->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label(__('Nombre')),
                ColorColumn::make('color')
                ->label(__('Color'))

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
            'index' => Pages\ListTareas::route('/'),
            'create' => Pages\CreateTarea::route('/create'),
            'edit' => Pages\EditTarea::route('/{record}/edit'),
        ];
    }
}
