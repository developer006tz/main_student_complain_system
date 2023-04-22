<?php

namespace App\Filament\Resources\SemesterResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\SemesterResource;

class ListSemesters extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = SemesterResource::class;
}
