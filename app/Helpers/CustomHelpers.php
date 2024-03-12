<?php

namespace App\Helpers;

use App\Models\Transactions;

class CustomHelpers
{
    public static function get_pinjam()
    {
        return Transactions::where('date_end', '<=', now())->join('members', 'transactions.member_id', '=', 'members.id')->get()->toArray();
    }
}
