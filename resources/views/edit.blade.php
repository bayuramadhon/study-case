@extends('layouts.admin')
@section('header','transaction')

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create New Catalog</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('transaction/'.$transaction->id) }}" method="post">
                @csrf

                {{method_field('PUT')}}
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$transaction->id}}">

                    <div class="form-group" id="member">
                        <label>Select</label>
                        <select class="form-control" name="member">
                            @foreach ($members as $member)
                            @if ($transaction->member_id === $member->id)
                            <option selected value="{{ $member->id }}">{{ $member->name }}</option>
                            @else
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date Start:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                    @foreach ($transactions as $transaction)
                            @endforeach
                                </span>
                            </div>
                            <input type="date" class="form-control float-right" name="date_start" id="date_start" value="{{$transaction->date_start}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Date End:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                    @foreach ($transactions as $transaction)
                            @endforeach
                                </span>
                            </div>
                            <input type="date" class="form-control float-right" name="date_end" id="date_end" value="{{$transaction->date_end}}">
                        </div>
                    </div>


                    <div class="form-group" id="book">
                        <label>Select</label>
                        <select class="form-control" name="book">
                            @foreach ($books as $book)
                            @foreach ($transactions as $transaction)
                            @if ($book->id === $transaction->book_id)
                            <option selected value="{{ $book->id }}">{{ $book->title }}</option>
                            @else
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endif
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>


                    <button type="submit" class="btn btn-primary">Submit</button>


            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection


