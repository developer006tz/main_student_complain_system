<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NtaLevel extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'nta_levels';

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
