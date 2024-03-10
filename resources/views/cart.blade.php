@extends('layouts.main')

@section('content')


<section class="page-section">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    @if(Session::has('order_placed'))
                    <div class="text-center pb-5">
                        <i style="font-size:200px" class="fa fa-check-circle m-5 text-success" aria-hidden="true"></i>
                        <br>
                        Order has been placed successfully.
                    </div>
                    @else
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted">{{count($products)}} items</h6>
                                    </div>
                                    {{-- @dump($total_summary) --}}
                                    <hr class="my-4">

                                    @foreach($products as $product)
                                    @php
                                        $product_data = \App\Models\Product::find($product['product_id']);
                                    @endphp

                                    <div class="row mb-4 d-flex justify-content-between align-items-center cart-product-row">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{$product_data->image}}" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-muted">{{$product_data->name}}</h6>
                                            <h6 class="text-black mb-0">{{$product['size']}}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2 add-item-to-cart" data-size="{{$product['size']}}" data-product-id="{{$product['product_id']}}" data-url="{{route('cart.store')}}" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input id="quantity_{{$product['product_id']}}_{{$product['size']}}" min="1" name="quantity" value="{{$product['quantity']}}" type="number" class="form-control form-control-sm" style="width:100px;" />
                                            <button class="btn btn-link px-2 add-item-to-cart" data-size="{{$product['size']}}" data-product-id="{{$product['product_id']}}" data-url="{{route('cart.store')}}" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0 product-price" data-unit-price="{{$product_data->varients->where('size',$product['size'])->first()->price}}">${{$product_data->varients->where('size',$product['size'])->first()->price * $product['quantity']}}</h6>
                                            ${{$product_data->varients->where('size',$product['size'])->first()->price." per unit"}}
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#!" class="text-muted delete-item-from-cart" data-size="{{$product['size']}}" data-product-id="{{$product['product_id']}}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    @endforeach
                                    <div class="pt-5">
                                        <h6 class="mb-0">
                                            <a href="{{route('welcome')}}" class="text-body">
                                                <i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">items {{$total_summary['count']}}</h5>
                                        <h5 class="total-amount">$ {{$total_summary['amount']}}</h5>
                                    </div>
                                    @if(auth()->user())
                                    <h5 class="text-uppercase mb-3">Delivery Address</h5>
                                    <div class="mb-4 pb-2">
                                        <select id="address_id" class="select form-control">
                                            @foreach($addresses as $address)
                                            <option {{($address->is_default == 1)?"selected":""}} value="{{$address->id}}">{{$address->line1}}, {{$address->line2}}, {{$address->city}}, {{$address->state}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    {{-- <h5 class="text-uppercase mb-3">Give code</h5>
                                    <div class="mb-5">
                                        <div class="form-outline">
                                            <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Examplea2">Enter your code</label>
                                        </div>
                                    </div>
                                    <hr class="my-4"> --}}
                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5 class="total-amount">$ {{$total_summary['amount']}}</h5>
                                    </div>
                                    @if(auth()->user())
                                    <a type="button" class="btn btn-dark btn-block btn-lg place-order" data-mdb-ripple-color="dark">Place Order</a>
                                    @else
                                    <a href="{{route('login')}}" type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Login</a>
                                    <a href="{{route('register')}}" type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Register</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script type="text/javascript">
        $('body').on('click','.add-item-to-cart',function(){
            console.log($('meta[name="_token"]').attr('content'));
            var url = $(this).data('url');
            var product_id = $(this).data('product-id');
            var size =  $(this).data('size');
            var quantity = $('#quantity_'+$(this).data('product-id')+'_'+$(this).data('size')).val();
            var text_field = '#quantity_'+$(this).data('product-id')+'_'+$(this).data('size');
            console.log(quantity);
            $.ajax({
                url: url,
                type: 'POST',
                dataType: "JSON",
                data: {
                    "_token": $('meta[name="_token"]').attr('content'),
                    "quantity":quantity,
                    "size":size,
                    "product_id":product_id
                },
                success: function ()
                {
                    console.log($(text_field).parent().parent().find('.product-price').text('$'+$(text_field).parent().parent().find('.product-price').data('unit-price') * quantity));
                    sync_total();
                    
                }
            });
        });

        $('body').on('click','.place-order',function(){
            var address_id = $('#address_id').val();
            $.ajax({
                url: '{{route('place.order')}}',
                type: 'POST',
                dataType: "JSON",
                data: {
                    "_token": $('meta[name="_token"]').attr('content'),
                    "address_id":address_id
                },
                success: function (res)
                {
                    // console.log(res);
                    window.location.reload();
                }
            });
        })

        $('body').on('click','.delete-item-from-cart',function(){
            // console.log($('meta[name="_token"]').attr('content'));
            
            var product_id = $(this).data('product-id');
            var size =  $(this).data('size');
            remove_item(product_id,size,$(this));

        });

        function remove_item(product_id,size,jQthis) {
            $.ajax({
                url: '{{route('delete.item')}}',
                type: 'POST',
                dataType: "JSON",
                data: {
                    "_token": $('meta[name="_token"]').attr('content'),
                    "size":size,
                    "product_id":product_id
                },
                success: function (response)
                {
                    if(response.status == "success"){
                        jQthis.closest('.cart-product-row').remove();
                        $('.cart-count').text(response.count);
                    }         
                    sync_total();   
                }
            });
        }

        function sync_total() {
            $.ajax({
                url: '{{route('total.summary')}}',
                type: 'POST',
                dataType: "JSON",
                data: {
                    "_token": $('meta[name="_token"]').attr('content'),
                },
                success: function (response)
                {
                    console.log(response);    
                    $('.total-amount').text('$ '+response.amount);       
                }
            });
        }

        
    </script>
@endpush