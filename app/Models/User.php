<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\Model;

class User extends EloquentUser
{
    protected $table = 'users';

    protected $guarded = ['id'];

    //protected $fillable = [
    //    'first_name',
    //];
}