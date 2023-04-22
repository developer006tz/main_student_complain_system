<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'start_date', 'end_date'];

    protected $searchableFields = ['*'];

    protected $table = 'academic_years';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }
}
