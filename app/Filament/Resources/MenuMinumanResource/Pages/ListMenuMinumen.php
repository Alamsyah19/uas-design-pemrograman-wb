<?php

namespace App\Filament\Resources\MenuMinumanResource\Pages;

use App\Filament\Resources\MenuMinumanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenuMinumen extends ListRecords
{
    protected static string $resource = MenuMinumanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
