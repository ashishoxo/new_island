@extends('layouts.main')

@section('content')
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
        	<div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{$product->image}}">
                        </a>
                    </div>
                    
                    <!-- thumbs-wrap.// -->
                    <!-- gallery-wrap .end// -->
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark"> {{$product->name}} </h4>
                        <div class="d-flex flex-row my-3">
                            {{-- <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1"> 4.5 </span>
                            </div>
                            <span class="text-muted">
                                <i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders </span> --}}
                            <span class="text-success">In stock</span>
                        </div>
                        <div class="mb-3">
                            <span class="h5 product-price">${{$product->varients[0]->price}}</span>
                            <span class="text-muted"></span>
                        </div>
                        <p> {{$product->description}} </p>
                       
                        <hr>
                        <div class="row mb-4">
                            <div class="col-md-4 col-6">
                                <label class="mb-2">Size</label>
                                <select class="form-select border border-secondary" id="varient"  style="height: 40px;">
                                    @foreach($product->varients as $varient)
                                    <option data-price="{{$varient->price}}">{{$varient->size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- col.// -->
                            <div class="col-md-4 col-6 mb-3">
                                <label class="mb-2 d-block">Quantity</label>
                                <div class="input-group mb-3" style="width: 170px;">
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" id="quantity" class="form-control text-center border border-secondary" value="1" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="#" class="btn btn-warning shadow-0"> Buy now </a> --}}
                        <a class="btn btn-primary shadow-0 add-item-to-cart" data-product-id="{{$product->id}}" data-url="{{route('cart.store')}}">
                            <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a>
                        {{-- <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> --}}
                            {{-- <i class="me-1 fa fa-heart fa-lg"></i> Save </a> --}}
                        <div class="text-success success-message mt-2"></div>
                    </div>
                </main>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('body').on('click','#button-addon2',function(){
            console.log('hello');
            if($('#quantity').val() < 30){
                $('#quantity').val(parseInt($('#quantity').val()) + 1)    
            }
            
        });
        $('body').on('click','#button-addon1',function(){
            if($('#quantity').val() > 1){
                $('#quantity').val($('#quantity').val() - 1)
            } 
        });

        $('body').on('click','.add-item-to-cart',function(){
            console.log($('meta[name="_token"]').attr('content'));
            var url = $(this).data('url');
            var product_id = $(this).data('product-id');
            var size = $('#varient').val();
            var quantity = $('#quantity').val();
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
                success: function (res)
                {
                    console.log(res);
                    $('.success-message').text(res.message);

                    if($('.cart-count').text() == ''){
                        $('.cart-count').text(1)
                    }else{
                        $('.cart-count').text(res.count);
                    }
                }
            });
        });

        $("#varient").change(function(){

            $('.product-price').text("$"+$(this).find(':selected').data('price'));
        })
    </script>
@endpush