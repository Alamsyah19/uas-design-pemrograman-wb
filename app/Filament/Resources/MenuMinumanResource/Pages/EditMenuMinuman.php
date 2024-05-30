<?php

namespace App\Filament\Resources\MenuMinumanResource\Pages;

use App\Filament\Resources\MenuMinumanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuMinuman extends EditRecord
{
    protected static string $resource = MenuMinumanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
