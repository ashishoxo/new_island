@extends('layouts.admin')
@section('title','Order Details')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Details of the order</h3>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
                <div>
                    Order ID: {{$order->id}}
                    <br>
                    No of items: {{$order->orderItems->count()}}
                    <br>
                    <table class="table">
                    @foreach($order->orderItems as $orderItem)
                        <tr>
                            <td>
                                <img style="width: 60px" src="{{$orderItem->product->image}}">
                            </td>
                            <td>{{$orderItem->product->name}}</td>
                            <td>{{$orderItem->size}} x {{$orderItem->quantity}}</td>
                        </tr>
                    @endforeach
                    </table>
                    <br>
                    Order By:{{$order->user->email}}
                    <br>
                    Delivery Address:{{$order->delivery_address}}
                    <br>
                    Current Status: {{$order->status}}
                    <br>
                    Change Status:
                    <select class="form-group">
                        <option>ordered</option>
                        <option>under_process</option>
                        <option>shipped</option>
                        <option>out_for_delivery</option>
                        <option>delivered</option>
                        
                    </select>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection