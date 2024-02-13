@extends('layouts.admin')
@section('title','Orders')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of all orders</h3>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>No of items</th>
                            <th>Ordered By</th>
                            <th>Ordered Date</th>
                            <th>Status</th>
                            <th>Action(s)</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->orderItems->count()}}</td>
                            <td>{{$order->user->email}}</td>
                            <td>{{$order->created_at->diffforhumans()}}</td>
                            <td>
                            	<span class="badge badge-success">{{$order->status}}</span>
                            </td>
                            <td>
                                <a href="{{route('orders.show',$order)}}" class="btn btn-primary">View Details</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
  $(function () {
    $("#example1").DataTable({
           order: [[indexOfDefaultSortColumn, "desc"]] 
})
    
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