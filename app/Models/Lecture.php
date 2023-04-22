<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecture extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'department_id', 'image', 'status'];

    protected $searchableFields = ['*'];

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
