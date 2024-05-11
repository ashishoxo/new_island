@extends('layouts.admin')
@section('title','Carts')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of all carts</h3>
            </div>
                
            
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Date Range Filter:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Search by Email/Name/Username:</label>
                            <div class="input-group">
                                
                                <select class="form-control select2">
                                    <option>ashish9436@gmail.com</option>
                                    <option>ashish9436+12@gmail.com</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pt-4 mt-2">
                        <button class="btn btn-primary">Search</button>
                        <button class="btn btn-secondary">Reset Filter</button>
                    </div>
                        
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Cart ID</th>
                            <th>No of items</th>
                            <th>Cart Owner</th>
                            <th>Cart Created Date</th>
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
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endpush
@push('scripts')
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
	<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
  $(function () {
    $('.select2').select2()
    $('#reservation').daterangepicker()
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