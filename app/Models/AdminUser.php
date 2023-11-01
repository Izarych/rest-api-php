<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;

class AdminUser extends Authenticable
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = ['email', 'name', 'password'];
}
