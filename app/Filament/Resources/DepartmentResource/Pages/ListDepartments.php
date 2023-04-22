<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\DepartmentResource;

class ListDepartments extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = DepartmentResource::class;
}
