@extends('layouts.admin')
@section('title','Categories')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of all categories</h3>
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
                        @foreach($categories as $category)
                        <tr>
                            <td><img src="{{$category->image}}" style="width:100px;"></td>
                            <td>{{$category->title}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                <a href="{{route('categories.edit',$category)}}" class="btn btn-primary">Edit</a>
                                <a href="" class="btn btn-danger delete" data-url="{{route('categories.destroy',$category)}}">Delete</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

	<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
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

  $('body').on('click','.delete',function(e){
    e.preventDefault();
    var url = $(this).data('url');
    Swal.fire({
      title: "Do you want to delete?",
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "Yes",
      denyButtonText: `No`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        
        $.ajax({
            url: url,
            type: 'POST',
            dataType: "JSON",
            data: {
                "_method": 'DELETE',
                "_token": $('meta[name="_token"]').attr('content'),
            },
            success: function ()
            {
                Swal.fire("Deleted!", "", "success");
                location.reload()
            }
        });
      } else if (result.isDenied) {
        // Swal.fire("Changes are not saved", "", "info");
      }
    });
  })
</script>
@endpush