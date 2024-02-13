@extends('layouts.main')

@section('content')
<section class="page-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My Orders') }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                        	@foreach($orders as $order)
						  	<li class="list-group-item d-flex justify-content-between align-items-center row">
						   		
						   			<div class="col-md-6">
						   				Order Id: {{$order->id}} ({{$order->orderItems->count()}} Items)
						   			</div>	
						   			<div class="col-md-3">
						   				{{$order->created_at->diffforhumans()}}
						   			</div>	
						   			<div class="col-md-3 ">
						   				<a class="btn btn-primary ">View Details</a>
						   			</div>	
						   		
						  	</li>
						  	@endforeach
						</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
