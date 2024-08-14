<?php

namespace App\Filament\Resources\NewItemResource\Pages;

use App\Filament\Resources\NewItemResource;
use Carbon\Carbon;
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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Runs before the form fields are saved to the database.
        $now = Carbon::now();

        // Check if publish_at is in the future or null
        if (!is_null( $data['publish_at']) && Carbon::parse( $data['publish_at'])->gt($now)) {
            $data['published'] = false;
        } else {
            $data['publish_at'] = $now;
            $data['published'] = true;
        }
        return $data;
    }
}
