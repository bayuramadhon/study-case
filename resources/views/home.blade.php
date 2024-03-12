@extends('layouts.admin')


@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="controller">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('transaction/create') }}" class="btn btn-sm btn-primary pull-right">Create new peminjam</a>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id ="datatable" class="table table-bordered">
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
                    {{-- <tbody>
                        @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $transaction->date_start }}</td>
                            <td>{{ $transaction->date_end}}</td>
                            <td>{{ $transaction->name}}</td>
                            <td>{{ $transaction->lama_pinjam}}</td>
                            <td>{{ $transaction->total_buku}}</td>
                            <td>{{ $transaction->total_bayar}}</td>


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

                    </tbody> --}}
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

@section('js')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript">
    var actionUrl = '{{ url('transactions')}}';
    var apiUrl = '{{ url('api/transactions')}}';

    var columns = [
        {data: 'DT_RowIndex', class:'text-center', orderable: true},
        {data: 'date_start', class:'text-center', orderable: true},
        {data: 'date_end', class:'text-center', orderable: false},
        {data: 'name', class:'text-center', orderable: true},
        {data: 'lama_pinjam', class:'text-center', orderable: true},
        {data: 'total_buku', class:'text-center', orderable: true},
        {data: 'total_bayar', class:'text-center', orderable: true},
        {data: 'status', class:'text-center', orderable: true},
        //untuk action
        {render: function (index, row, data, meta)   {
            return `
            <a href="{{ url('transaction/${data.id}/edit') }}" class="btn btn-warning btn-sm">
                Edit
            </a>

            <form action="{{ url('transaction/${data.id}') }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
            </form>;`

        }, orderable: false, width: '200px', class: 'text-center'},
    ];

    var controller = new Vue({
    el: '#controller',
    data: {
        datas: [],
        data: {},
        actionUrl,
        apiUrl,
        editStatus : false,
    },
    mounted: function () {
        this.datatable();
    },
    methods: {
        datatable() {
            const _this = this;
            _this.table = $('#datatable').DataTable({
                ajax: {
                    url: _this.apiUrl,
                    type: 'GET',
                },
                    columns }).on('xhr', function () {
                    _this.datas = _this.table.ajax.json().data;
                });
                // columns: { "data":"id",
                // "render": function(data, type, row, meta){
                // if(type === 'display'){
                //     data = '<a href="{{url('/transaction/{id}/edit')}} + data + '">' + row.Activity_Id + '</a>';
                //     }
                // return data;
                // }
    }}
})

</script>
@endsection

