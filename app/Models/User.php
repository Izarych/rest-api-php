<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['email', 'username', 'name', 'is_blocked'];

}
