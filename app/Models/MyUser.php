<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyUser extends Authenticatable
{
    use HasFactory;

    const UPDATED_AT = "EditDateTime";
    const CREATED_AT = "CreationDateTime";

    protected $table = "users";
    protected $primaryKey = "Id";

    protected $fillable = [
        'Login', 'Password', 'IsAdmin', 'IsActive'
    ];

    protected $hidden = [
        'Password',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }
}