<?php

namespace App\Filament\Resources\NewItemResource\Pages;

use App\Filament\Resources\NewItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewItem extends EditRecord
{
    protected static string $resource = NewItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
