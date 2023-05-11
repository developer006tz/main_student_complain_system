<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Models\Traits\FilamentTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use FilamentTrait;

    protected $fillable = ['name', 'email', 'phone', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function lecture()
    {
        return $this->hasOne(Lecture::class);
    }

    public function departmentHead()
    {
        return $this->hasOne(DepartmentHead::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
