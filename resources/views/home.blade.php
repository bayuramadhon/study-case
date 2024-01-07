@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('transactions/create') }}" class="btn btn-sm btn-primary pull-right">Create New Publisher</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th class="text-center">Tanggal pinjam</th>
                            <th class="text-center">Tanggal kembali</th>
                            <th class="text-center">Nama peminjam</th>
                            <th class="text-center">Lama pinjam (hari)</th>
                            <th class="text-center">Total buku</th>
                            <th class="text-center">Total bayar</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $transaction->date_start }}</td>
                            <td>{{ $transaction->date_end}}</td>
                            <td>{{ $transaction->name}}</td>
                            <td>{{ $transaction->address}}</td>
                            <td class="text-center">
                                <a href="{{url('transactions/'.$transaction->id.'/edit')}}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ url('transactions',['id' => $transaction->id])}}" method="post">
                                    <input class="btn btn-danger btn-sm" type="submit" value="Delete"
                                        onclick="return confirm('Are you sure')">
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            {{-- <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div> --}}
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
