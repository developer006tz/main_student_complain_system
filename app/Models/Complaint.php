<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'complain_type_id',
        'student_id',
        'department_id',
        'program_id',
        'course_id',
        'lecture_id',
        'semester_id',
        'academic_year_id',
        'description',
        'solution',
        'date',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function complainType()
    {
        return $this->belongsTo(ComplainType::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function resolves()
    {
        return $this->hasMany(Resolve::class)->latest()->take(1);
    }
}
