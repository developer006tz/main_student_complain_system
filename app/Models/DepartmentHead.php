<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartmentHead extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'department_id'];

    protected $searchableFields = ['*'];

    protected $table = 'department_heads';

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
