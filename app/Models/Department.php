<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'code'];

    protected $searchableFields = ['*'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function departmentHead()
    {
        return $this->hasOne(DepartmentHead::class);
    }
}
