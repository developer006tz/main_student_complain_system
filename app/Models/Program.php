<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'capacity',
        'nta_level_id',
        'department_id',
    ];

    protected $searchableFields = ['*'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function ntaLevel()
    {
        return $this->belongsTo(NtaLevel::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class);
    }
}
