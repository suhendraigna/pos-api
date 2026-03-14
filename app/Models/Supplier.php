<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'store_id',
        'name',
        'phone',
        'address',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'name' => 'string',
        'phone' => 'string',
        'address' => 'string',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
