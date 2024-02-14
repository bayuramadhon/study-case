<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transactions;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'date_start' => ['required'],
            'date_end' => ['required'],
            'name' => ['required'],
            'lama_pinjam' => ['required'],
            'total_buku' => ['required'],
            'total_bayar' => ['required'],
            'status' => ['required'],
        ]);

        DB::transaction(function () {
            // create transaction
            Transaction::create($request->all());

            // create transaction detail
            TransactionDetail::create(transaction - id);

            // update boook

            DB::delete('delete from posts');
        });



        return redirect('transactions');
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
