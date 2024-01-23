@extends('layouts.main')

@section('content')
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->
        {{-- @dd($category) --}}
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{$category->title}}</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
        	@foreach($category->products as $product)
            <div class="col-md-6 col-lg-4 mb-5" onclick="window.location='{{route('home.product.details',$product->id)}}';">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1" style="border:1px solid #e8e8e8">
                    <div style="max-height: 250px;overflow: hidden;">
                        
                        <img style="width:100%" class="img-fluid" src="{{$product->image}}" alt="..." />
                    </div>
                    <div class="m-3 ">
                        <h4>{{$product->name}}</h4>
                        <p>{{$product->description}}</p>
                    </div>
                        
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection