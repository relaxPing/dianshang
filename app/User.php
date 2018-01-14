<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /*use Notifiable;
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];*/
    protected $table = 'administrators';
    public $primaryKey = 'id';
    public $timestamps = false;
    public $rememberTokenName = '';
    public $guarded = [];
    protected $hidden = [
        'remember_token',
    ];

    //下面两个方法用于存unix时间戳
    protected function getDateFormat()
    {
        return 'U';
    }

    protected function asDateTime($value)
    {
        return $value;
    }
}
