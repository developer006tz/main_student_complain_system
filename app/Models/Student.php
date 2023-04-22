<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'department_id',
        'program_id',
        'country_id',
        'gender',
        'date_of_birth',
        'admission_id',
        'maritial_status',
        'photo',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
