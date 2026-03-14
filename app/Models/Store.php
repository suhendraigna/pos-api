<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email'
    ];

    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'email' => 'string',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function stockLedgers()
    {
        return $this->hasMany(StockLedger::class);
    }
}
