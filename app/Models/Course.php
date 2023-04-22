<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'credit',
        'elective',
        'semester_id',
        'department_id',
        'nta_level_id',
        'program_id',
    ];

    protected $searchableFields = ['*'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function ntaLevel()
    {
        return $this->belongsTo(NtaLevel::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class);
    }
}
