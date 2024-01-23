@extends('layouts.admin')
@section('title','Add Product')
@section('content')
	<div class="row">
	    <!-- left column -->
	    <div class="col-md-12">
	        <!-- jquery validation -->
	        <div class="card card-primary">
	            <div class="card-header">
	                <h3 class="card-title">Add New Product
	                </h3>
	            </div>
	            <!-- /.card-header -->
	            <!-- form start -->
	            <form id="quickForm" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
	            	@csrf
	                <div class="card-body">
	                    <div class="form-group">
	                        <label for="exampleInputEmail1">Name</label>
	                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" aria-describedby="exampleInputEmail1-error" aria-invalid="true" required value="{{ old('name') }}">
	                        @error('name')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="form-group">
	                        <label for="exampleInputPassword1">Description</label>
	                        <textarea name="description" placeholder="Description" class="form-control" required></textarea>
	                        @error('description')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="form-group">
							<label for="exampleInputFile">Product Image</label>
							<input type="file" class="form-control" id="exampleInputFile" name="image" required>
							@error('image')
							    <div class="error">{{ $message }}</div>
							@enderror
						</div>
	                    <div class="form-group">
	                        <label for="exampleInputEmail1">Category</label>
	                        <select name="category" class="form-control" required>
	                        	<option selected disabled>Select Category</option>
	                        	@foreach($categories as $category)
	                        		<option value="{{$category->id}}">
	                        			{{$category->title}}
	                        		</option>
	                        	@endforeach
	                        </select>
	                        @error('title')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="row-wrapper">
	                    	<label for="exampleInputEmail1">Varients</label>
	                    	<div class="row">
	                    		<div class="col-2">
	                    			Size
	                    		</div>
	                    		<div class="col-2">
	                    			Price
	                    		</div>
	                    	</div>
	                    	<div class="row">
	                    		<div class="col-2">
	                    			<input type="text" name="varient[0][size]" class="form-control" placeholder="Size" required>
	                    		</div>
	                    		<div class="col-2">
	                    			<input type="text" name="varient[0][price]" class="form-control" placeholder="Price" required>
	                    		</div>
	                    		<div class="col-2">
	                    			<i class="fas fa-plus-circle text-success add-more"></i>
	                    		</div>
	                    	</div>
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