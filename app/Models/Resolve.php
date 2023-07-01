<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolve extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'lecture_id',
        'complaint_id',
        'resolve_status',
        'remark',
        'date',
        'status',
    ];

    public function lecture(){
        return $this->belongsTo(Lecture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    } 
}
