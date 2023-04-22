<?php

namespace App\Filament\Resources\CourseResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CourseResource;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}
