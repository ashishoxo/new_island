@extends('layouts.main')

@section('content')
<!-- Portfolio Section-->
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Categories</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <!-- Portfolio Item 1-->
            @php
                $categories = \App\Models\Category::all();
                // dd($categories);
            @endphp

            @foreach($categories as $category)
            <div class="col-md-6 col-lg-4 mb-5" onclick="window.location='{{route('home.products',$category->id)}}';">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1" style="border:1px solid #e8e8e8">
                    <div style="max-height: 250px;overflow: hidden;">
                        
                        <img style="width:100%" class="img-fluid" src="{{$category->image}}" alt="..." />
                    </div>
                    <div class="m-3 ">
                        <h4>{{$category->title}}</h4>
                        <p>{{$category->description}}</p>
                    </div>
                        
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</section>
<!-- About Section-->
<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">About</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-4 ms-auto"><p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed venenatis libero. Etiam volutpat lobortis tellus in mollis. Nulla facilisi. Curabitur dapibus cursus congue. Sed pretium lobortis venenatis. Aliquam mattis felis a nisi tincidunt egestas. Nam efficitur euismod erat ultrices hendrerit.</p></div>
            <div class="col-lg-4 me-auto"><p class="lead">Integer interdum nulla sed lacus consectetur, vitae molestie orci faucibus. Sed vitae finibus arcu. Etiam dignissim sollicitudin orci, eu accumsan dui commodo eu. Nunc nec arcu massa. Mauris pellentesque rhoncus enim at porttitor. Suspendisse potenti. Maecenas orci neque, dictum auctor sodales sed, sodales vel quam!</p></div>
        </div>
        <!-- About Section Button-->
        
    </div>
</section>
@endsection