<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'store_id',
        'cash_session_id',
        'user_id',
        'invoice_number',
        'subtotal',
        'discount',
        'tax',
        'total',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'cash_session_id' => 'integer',
        'user_id' => 'integer',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'status' => 'string',
        'paid_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function cashSession()
    {
        return $this->belongsTo(CashSession::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}
