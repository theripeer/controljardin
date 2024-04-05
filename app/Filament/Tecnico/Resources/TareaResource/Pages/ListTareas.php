<?php

namespace App\Filament\Tecnico\Resources\TareaResource\Pages;

use App\Filament\Tecnico\Resources\TareaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTareas extends ListRecords
{
    protected static string $resource = TareaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
