<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TecnicoResource\Pages;
use App\Filament\Resources\TecnicoResource\RelationManagers;
use App\Models\Tecnico;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class TecnicoResource extends Resource
{
    protected static ?string $model = Tecnico::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $tenantOwnershipRelationshipName = 'empresas';

    protected static ?int $navigationSort = 0;
    protected static ?string $navigationGroup = 'Administración';
    //protected static ?string $navigationLabel = 'Tecnicos';


    public static function getPluralLabel(): ?string
    {
        return __('Tecnicos');
    }

    public static function getLabel(): ?string
    {
        return __('Tecnico');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label(__('Nombre'))
                ->required()
                ->maxLength(255)
                ->columnSpan(1),
                TextInput::make('email')
                ->email()
                ->required()
                ->unique(Tecnico::class, 'email', ignoreRecord: true)
                ->columnSpan(1),
                TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->confirmed()
                ->minLength(8)
                ->maxLength(200)
                ->label(__('Contraseña')),
                TextInput::make('password_confirmation')
                ->password()
                ->label(__('Confirmar contraseña')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label(__('Nombre'))
                ->searchable(),
                TextColumn::make('email')
                ->label(__('Email'))
                ->searchable()


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (Tecnico $tecnico) {
                        // Desvincular el técnico de todas las empresas
                        $tecnico->empresas()->detach(filament()->getTenant()->id);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
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
            'index' => Pages\ListTecnicos::route('/'),
            'create' => Pages\CreateTecnico::route('/create'),
            'edit' => Pages\EditTecnico::route('/{record}/edit'),
        ];
    }
}
