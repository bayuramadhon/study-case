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
            <form action="{{ url('catalogs') }}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group" id="member">
                        <label>Select</label>
                        <select class="form-control" name="member">
                            @foreach ($members as $member)
                            <option value="{{ $member->name }}">{{ $member->name }}</option>
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
                            <input type="text" class="form-control float-right" id="reservation">
                        </div>
                    </div>

                    <div class="form-group" id="book">
                        <label>Select</label>
                        <select class="form-control" name="book">
                            @foreach ($books as $book)
                            <option value="{{ $book->title }}">{{ $book->title }}</option>
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

<script type="text/javascript">
//Date range as a button
$('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

</script>
