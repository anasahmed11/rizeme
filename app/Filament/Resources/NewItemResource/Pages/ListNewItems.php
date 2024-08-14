<?php

namespace App\Filament\Resources\NewItemResource\Pages;

use App\Filament\Resources\NewItemResource;
use App\Models\NewItem;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListNewItems extends ListRecords
{
    protected static string $resource = NewItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All news')->badge(NewItem::query()->count()),
            'published' => Tab::make('published news')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('published', true))
                ->badge(NewItem::query()->where('published', true)->count())
                ->badgeColor('success'),
            'un published' => Tab::make('un published news')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('published', false))
                ->badge(NewItem::query()->where('published', false)->count())
                ->badgeColor('danger'),
        ];
    }
}
