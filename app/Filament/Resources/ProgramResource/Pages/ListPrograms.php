<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ProgramResource;

class ListPrograms extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ProgramResource::class;
}
