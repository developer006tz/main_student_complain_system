<?php

namespace App\Filament\Resources\MessageResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\MessageResource;

class ListMessages extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = MessageResource::class;
}
