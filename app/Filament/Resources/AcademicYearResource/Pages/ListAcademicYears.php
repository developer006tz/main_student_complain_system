<?php

namespace App\Filament\Resources\AcademicYearResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\AcademicYearResource;

class ListAcademicYears extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AcademicYearResource::class;
}
