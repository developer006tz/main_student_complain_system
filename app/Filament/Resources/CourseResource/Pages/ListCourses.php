<?php

namespace App\Filament\Resources\CourseResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CourseResource;
use App\Filament\Traits\HasDescendingOrder;

class ListCourses extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CourseResource::class;
}
