<?php

namespace App\Filament\Resources\EnrollmentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\EnrollmentResource;

class ListEnrollments extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = EnrollmentResource::class;
}
