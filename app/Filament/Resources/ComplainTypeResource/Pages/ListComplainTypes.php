<?php

namespace App\Filament\Resources\ComplainTypeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ComplainTypeResource;

class ListComplainTypes extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ComplainTypeResource::class;
}
