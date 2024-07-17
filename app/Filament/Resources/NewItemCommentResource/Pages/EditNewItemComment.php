<?php

namespace App\Filament\Resources\NewItemCommentResource\Pages;

use App\Filament\Resources\NewItemCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewItemComment extends EditRecord
{
    protected static string $resource = NewItemCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
