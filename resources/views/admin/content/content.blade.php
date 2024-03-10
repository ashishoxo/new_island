@extends('layouts.admin')
@section('title','Content')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Content</h3>
            </div>
            {{-- @dd($data) --}}
            <!-- /.card-header -->
            <div class="card-body">
            	@if (session()->has('success'))
            		<div class="alert alert-success">
            			{{session()->get('success')}}
            		</div>
            	@endif
            	<form action="" class="row" method="POST">
            		@csrf
            		<div class="col-md-6">
            			<label>About text left</label>
            			<textarea name="about_left" class="form-control" rows="10">{{@$data['about_left']->content}}</textarea>
            		</div>
            		<div class="col-md-6">
            			<label>About text right</label>
            			<textarea name="about_right" class="form-control" rows="10">{{@$data['about_right']->content}}</textarea>
            		</div>
            		<div class="col-md-12 text-right">
            			<button type="submit" class="btn btn-primary mt-2">Save</button>
            		</div>
            	</form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
