<?php

namespace App\Filament\Resources\MessageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MessageResource;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;
}
