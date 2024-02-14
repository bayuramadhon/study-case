<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->belongsTo('App\Models\book', 'book_id');
    }
    public function transaction()
    {
        return $this->belongsTo('App\Models\transaction', 'transaction_id');
    }
}
