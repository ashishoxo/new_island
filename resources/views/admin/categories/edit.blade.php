@extends('layouts.admin')
@section('title','Edit Category')
@section('content')
	<div class="row">
	    <!-- left column -->
	    <div class="col-md-12">
	        <!-- jquery validation -->
	        <div class="card card-primary">
	            <div class="card-header">
	                <h3 class="card-title">Edit Category
	                </h3>
	            </div>
	            <!-- /.card-header -->
	            <!-- form start -->
	            <form id="quickForm" action="{{route('categories.update',$category)}}" method="POST" enctype="multipart/form-data">
	            	@csrf
	            	@method('PUT')
	                <div class="card-body">
	                    <div class="form-group">
	                        <label for="exampleInputEmail1">Title</label>
	                        <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" aria-describedby="exampleInputEmail1-error" aria-invalid="true" required value="{{ $category->title }}">
	                        @error('title')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="form-group">
	                        <label for="exampleInputPassword1">Description</label>
	                        <textarea name="description" placeholder="Description" class="form-control" required>{{ $category->description }}</textarea>
	                        @error('description')
							    <div class="error">{{ $message }}</div>
							@enderror
	                    </div>
	                    <div class="form-group">
	                    	<img src="{{ $category->image }}" style="width: 200px;">
	                    	<br>
							<label for="exampleInputFile">Category Image</label>
							<input type="file" class="form-control" id="exampleInputFile" name="image">
							@error('image')
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

@push('scripts')
	<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
	<script type="text/javascript">
		$('#quickForm').validate()
	</script>
@endpush