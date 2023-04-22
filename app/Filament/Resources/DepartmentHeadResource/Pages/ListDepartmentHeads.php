<?php

namespace App\Filament\Resources\DepartmentHeadResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\DepartmentHeadResource;

class ListDepartmentHeads extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = DepartmentHeadResource::class;
}
