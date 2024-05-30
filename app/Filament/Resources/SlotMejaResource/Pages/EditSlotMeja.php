<?php

namespace App\Filament\Resources\SlotMejaResource\Pages;

use App\Filament\Resources\SlotMejaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSlotMeja extends EditRecord
{
    protected static string $resource = SlotMejaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
