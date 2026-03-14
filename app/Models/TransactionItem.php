<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionItem extends Model
{
    use HasFactory;

    protected $table = 'transaction_items';

    protected $fillable = [
        'tansaction_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
        'transaction_id' => 'integer',
        'product_id' => 'integer',
        'product_name' => 'string',
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'subtotal' => 'decimal:2',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
