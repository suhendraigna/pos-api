<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
    ];

    public function userStores()
    {
        return $this->hasMany(UserStore::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_users')
                ->withPivot('role')
                ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function cashSessions()
    {
        return $this->hasMany(CashSession::class);
    }

    public function
}
