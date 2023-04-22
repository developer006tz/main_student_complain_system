<?php

namespace App\Filament\Resources\LectureResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\LectureResource;

class ListLectures extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = LectureResource::class;
}
