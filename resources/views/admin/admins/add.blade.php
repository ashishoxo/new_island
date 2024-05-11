@extends('layouts.admin')
@section('title','Add Admin')
@section('content')
	<div class="row">
	    <!-- left column -->
	    <div class="col-md-12">
	        <!-- jquery validation -->
	        <div class="card card-primary">
	            <div class="card-header">
	                <h3 class="card-title">Add New Admin
	                </h3>
	            </div>
	            <!-- /.card-header -->
	            <!-- form start -->
	            <form id="quickForm" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
	            	@csrf
	                <div class="card-body">
	                    <div class="form-group">
	                        <label >First Name</label>
	                        <input type="text" name="first_name" class="form-control" placeholder="First Name" aria-describedby="exampleInputEmail1-error" aria-invalid="true" required >
	                        @error('first_name')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="form-group">
	                        <label >Last Name</label>
	                        <input type="text" name="last_name" class="form-control" placeholder="Last name" aria-describedby="exampleInputEmail1-error" aria-invalid="true" required >
	                        @error('last_name')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="form-group">
	                        <label >Email</label>
	                        <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="exampleInputEmail1-error" aria-invalid="true" required >
	                        @error('email')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="form-group">
	                        <label >Password</label>
	                        <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
	                        @error('password')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    
	                    <div class="form-group">
	                        <label >Confirm Password</label>
	                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
	                        @error('password_confirmation')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    
	                    
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
	                    <button type="submit" class="btn btn-primary">Submit</button>
	                </div>
	            </form>
	        </div>
	        <!-- /.card -->
	    </div>
	    <!--/.col (left) -->
	    <!-- right column -->
	    <div class="col-md-6"></div>
	    <!--/.col (right) -->
	</div>
@endsection
@push('styles')
	<style type="text/css">
		.row-wrapper i{
			line-height: 38px;
		}
		.row-wrapper > .row{
			margin-bottom: 20px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
	<script type="text/javascript">
		$('#quickForm').validate();

		$('body').on('click','.add-more',function(){

			count = $(".row-wrapper > .row").length - 1;
			
			$('.row-wrapper').append(`
				<div class="row">
            		<div class="col-2">
            			<input type="text" name="varient[`+count+`][size]" class="form-control" placeholder="Size" required>
            		</div>
            		<div class="col-2">
            			<input type="text" name="varient[`+count+`][price]" class="form-control" placeholder="Price" required>
            		</div>
            		<div class="col-2">
            			<i class="fas fa-plus-circle text-success add-more"></i>
            			<i class="fas fa-minus-circle text-danger delete-item"></i>
            		</div>
            	</div>
			`);
		})
	</script>
@endpush