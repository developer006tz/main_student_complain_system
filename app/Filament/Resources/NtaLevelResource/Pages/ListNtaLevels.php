<?php

namespace App\Filament\Resources\NtaLevelResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\NtaLevelResource;

class ListNtaLevels extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = NtaLevelResource::class;
}
