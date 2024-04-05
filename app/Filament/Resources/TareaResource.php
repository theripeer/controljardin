<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TareaResource\Pages;
use App\Filament\Resources\TareaResource\RelationManagers;
use App\Models\Tarea;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TareaResource extends Resource
{
    protected static ?string $model = Tarea::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationGroup = 'Ordenes';

    public static function getPluralLabel(): ?string
    {
        return __('Tareas');
    }

    public static function getLabel(): ?string
    {
        return __('Tarea');
    }
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Formulario Servicio')
                ->schema([
                        //TextInput::make('empresa_id'),
                        /*Forms\Components\Select::make('empresa_id')
                        ->relationship('owner', 'name')
                        ->required(),*/
                        //->searchable(),
                        Forms\Components\Hidden::make('empresa_id')
                            ->default(auth()->user()->empresa_id),
                        Forms\Components\Select::make('tecnico_id')
                        ->relationship('tecnico', 'name')
                        ->required(),
                        //->searchable(),
                        TextInput::make('folio')
                        ->autofocus()
                        ->required()
                        ->minLength(13) // Mínimo de caracteres para cumplir con el patrón
                        ->maxLength(13) // Máximo de caracteres para cumplir con el patrón
                        ->unique(static::getModel(), 'folio', ignoreRecord: true)
                        ->label(__('Numero de folio'))
                        ->extraAttributes(['pattern' => '[A-Za-z0-9]{6}-[A-Za-z0-9]{6}'])
                        ->hint(__('requerido: ABC123-XYZ789')),
                        TextInput::make('direccion')
                        ->columnSpan(2),
                        Forms\Components\Select::make('especie_id')
                        ->relationship('especie', 'name')
                        ->required(),
                        //->searchable(),
                        Forms\Components\Select::make('servicio_id')
                        ->relationship('servicio', 'name')
                        ->required(),
                        TextInput::make('cant_servicios'),
                        TextInput::make('dap'),
                        Forms\Components\Select::make('plazos')
                        ->label(__('Plazo de cumplimiento'))
                        ->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                            '9' => '9',
                            '10' => '10'
                        ]),
                        Forms\Components\Select::make('est_fitosanitario')
                        ->label(__('Estado Fitosanitario'))
                        ->options([
                            'BUENO' => 'BUENO',
                            'REGULAR' => 'REGULAR',
                            'MALO' => 'MALO',
                            'MUERTO' => 'MUERTO'
                        ]),
                        Forms\Components\Select::make('estados')
                        ->label(__('Estado'))
                        ->options([
                            'CREADA' => 'CREADA',
                            'EN PROCESO' => 'EN PROCESO',
                            'RECHAZADA' => 'RECHAZADA',
                            'REALIZADA' => 'REALIZADA'
                        ]),
                        Forms\Components\Select::make('estpago')
                        ->label(__('Estado Pago'))
                        ->options([
                            'POR PAGAR' => 'POR PAGAR',
                            'PAGADO' => 'PAGADO'
                        ]),
                        FileUpload::make('image1')
                        ->label(__('Imagen 1'))
                        ->image()
                        ->directory('tareas'),
                        FileUpload::make('image2')
                        ->label(__('Imagen 2'))
                        ->image()
                        ->directory('tareas'),
                        MarkdownEditor::make('observacion')
                        ->columnSpan('full')
                        ->label(__('Comentarios')),
                        FileUpload::make('image3')
                        ->label(__('Imagen 3'))
                        ->image()
                        ->directory('tareas'),
                        FileUpload::make('image4')
                        ->label(__('Imagen 4'))
                        ->image()
                        ->directory('tareas')

                        //->imagen()->preserveFilenames()
                        //->columnSpan('full')
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('folio')
                ->searchable()
                ->sortable()
                ->label(__('Folio')),
                Tables\Columns\TextColumn::make('tecnico.name')
                        ->label(__('Cuadrilla'))
                        ->sortable()
                        ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                        ->label(__('Creado'))
                        ->dateTime()
                        ->sortable(),
                TextColumn::make('plazos')
                        ->searchable()
                        ->sortable()
                        ->label(__('Plazo')),
                TextColumn::make('estados')
                        ->badge()
                        ->searchable()
                        ->sortable()
                        ->label(__('Estados')),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
