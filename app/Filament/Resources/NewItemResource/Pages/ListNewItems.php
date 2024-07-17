<?php

namespace App\Filament\Resources\NewItemResource\Pages;

use App\Filament\Resources\NewItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewItems extends ListRecords
{
    protected static string $resource = NewItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
