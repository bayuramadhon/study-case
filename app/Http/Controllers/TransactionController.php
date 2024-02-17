<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transactions;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transactions::getOrdersList();
        $transaction_details = TransactionDetail::all();
        $members = Member::all();
        //contoh liat data kosong atau array
        // $transactions = [];
        // $transaction_details = [];
        // $members = [];
        return view('home', compact('transactions', 'transaction_details', 'members'));
        // return view('home');
    }

    public function api()
    {
        $transactions = Transactions::getOrdersList();
        // return json_encode($transactions);

        $datatables = datatables()->of($transactions)
            ->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // $member = DB::table('name')
        $members = Member::all();
        $books = Book::all();
        return view('create', compact('members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'date_start' => ['required'],
        //     'date_end' => ['required'],
        //     'name' => ['required'],
        //     'lama_pinjam' => ['required'],
        //     'total_buku' => ['required'],
        //     'total_bayar' => ['required'],
        //     'status' => ['required'],
        // ]);
        // dd($request);


        DB::transaction(function () use ($request) {
            $parts = explode(" - ", $request->reservation);
            $date_start = $parts[0];
            $date_end = $parts[1];

            $trx = new Transactions;
            $trx->member_id = $request->member;
            $trx->date_start = $date_start;
            $trx->date_end = $date_end;
            $trx->status = 0;
            $trx->save();


            $trx_detail = new TransactionDetail;
            $trx_detail->transaction_id = $trx->id;
            $trx_detail->book_id = $request->book;
            $trx_detail->qty = 1;
            $trx_detail->save();

            $book = Book::find($trx_detail->book_id);
            $book->qty -= 1;
            $book->save();

            // // create transaction detail
            // TransactionDetail::create(transaction - id);

            // // update boook

            // DB::delete('delete from posts');
        });



        return redirect('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transactions)
    {
        //
    }
}
