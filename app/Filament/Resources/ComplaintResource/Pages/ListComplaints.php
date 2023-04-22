<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ComplaintResource;

class ListComplaints extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ComplaintResource::class;
}
