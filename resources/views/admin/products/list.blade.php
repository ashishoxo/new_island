@extends('layouts.admin')
@section('title','Products')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of all products</h3>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action(s)</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td><img src="{{$product->image}}" style="width:100px;"></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>
                                <a href="" class="btn btn-primary">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        
                        
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
@push('styles')
	<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@push('scripts')
	<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

	<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush