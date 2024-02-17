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
            <form action="{{ url('transaction/store') }}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group" id="member">
                        <label>Member</label>
                        <select class="form-control" name="member">
                            @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date range:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" name="reservation" class="form-control float-right" id="reservation">
                        </div>
                    </div>

                    <div class="form-group" id="book">
                        <label>Book</label>
                        <select class="form-control" name="book">
                            @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
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


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
//Date range as a button
$('#reservation').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    }
});

</script>
@endsection

