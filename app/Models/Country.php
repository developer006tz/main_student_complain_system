<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'nicename', 'iso3'];

    protected $searchableFields = ['*'];

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
