<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use APP\Models\Transactions;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transactions::all();
        $Transaction_details = TransactionDetail::all();
        $members = Member::all();
        return view('home', compact('transactions', 'transaction_details', 'members'));
        // return view('home');
    }

    public function api()
    {
        $books = Book::all();
        return json_encode($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}