<?php

namespace App\Filament\Resources\NewItemResource\Pages;

use App\Filament\Resources\NewItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewItem extends CreateRecord
{
    protected static string $resource = NewItemResource::class;

    protected function afterSave():void{
        parent::afterSave();
        $this->record->published = 0;
        $this->record->save();
    }
}
