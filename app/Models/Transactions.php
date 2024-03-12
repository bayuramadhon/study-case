<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Transactions extends Model
{
    use HasFactory;

    public static function getOrdersList()
    {
        $query = "SELECT t.id,t.date_start,
        t.date_end,
        m.name,
        DATEDIFF(t.date_end, t.date_start) AS lama_pinjam,
        COUNT(td.transaction_id) AS total_buku,
        SUM(b.price*td.qty) AS total_bayar,
        CASE t.status
            WHEN false THEN 'Belum Dikembalikan'
            ELSE 'Sudah Dikembalikan'
        END AS status
        FROM transactions AS t
        JOIN transaction_details AS td ON t.id = td.transaction_id
        JOIN members AS m ON t.member_id = m.id
        JOIN books b on td.book_id = b.id
        GROUP BY 1,2,3,4,8
        LIMIT 20;";
        return DB::select($query);
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }

    public function transaction_detail()
    {
        return $this->hasMany('App\Models\TransactionDetail', 'transaction_id');
    }
}
