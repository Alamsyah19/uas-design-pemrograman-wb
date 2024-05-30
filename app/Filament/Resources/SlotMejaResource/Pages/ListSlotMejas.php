<?php

namespace App\Filament\Resources\SlotMejaResource\Pages;

use App\Filament\Resources\SlotMejaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSlotMejas extends ListRecords
{
    protected static string $resource = SlotMejaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
