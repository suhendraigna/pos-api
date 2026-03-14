<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreUser extends Model
{
    use HasFactory;

    protected $table = 'store_users';

    protected $fillable = [
        'store_id',
        'user_id',
        'role',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'user_id' => 'integer',
        'role' => 'string',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
