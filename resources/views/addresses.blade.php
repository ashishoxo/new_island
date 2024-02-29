@extends('layouts.main')

@section('content')
<section class="page-section">
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row ">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Add New Address') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.address.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="line1" class="col-md-4 col-form-label text-md-end">{{ __('Address Line 1') }}</label>

                                <div class="col-md-6">
                                    <input id="line1" type="text" class="form-control" name="line1" required>

                                    @error('line1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="line2" class="col-md-4 col-form-label text-md-end">{{ __('Address Line 2') }}</label>

                                <div class="col-md-6">
                                    <input id="line2" type="text" class="form-control" name="line2">

                                    @error('line2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city">

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="state" class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>

                                <div class="col-md-6">
                                    <input id="state" type="text" class="form-control" name="state">

                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="zip" class="col-md-4 col-form-label text-md-end">{{ __('ZIP') }}</label>

                                <div class="col-md-6">
                                    <input id="zip" type="text" class="form-control" name="zip">

                                    @error('zip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control" name="country">

                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="address_type" class="col-md-4 col-form-label text-md-end">{{ __('Address Type') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="address_type" type="text" class="form-control" name="address_type"> --}}

                                    <select class="form-control" name="type">
                                        <option disabled selected>Select Address</option>
                                        <option value="home">Home</option>
                                        <option value="office">Office</option>
                                        <option value="appartment">Appartment</option>
                                        <option value="building">Building</option>
                                        
                                    </select>

                                    @error('address_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                {{-- @dd($addresses) --}}
                @foreach($addresses as $key => $address)
                <div class="card p-3 mb-3">
                    {{$address->line1}}
                    <br>
                    {{$address->line2}}
                    <br>
                    {{$address->city}},
                    <br>
                    {{$address->state}}
                    <br>
                    {{$address->country}}
                    <br>
                    {{$address->zip}}
                    <br>
                    {{$address->type}}

                    @if($address->is_default == 1)
                        <span class="position-absolute text-success" style="right: 20px;">Default Address</span>
                    @else
                        <button class="position-absolute btn btn-primary" style="right: 20px;" onclick="event.preventDefault();
                                                 document.getElementById('make_default_{{$key}}').submit();">Make Default</button>
                        <form id="make_default_{{$key}}" action="{{ route('make.address.default') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" name="address_id" value="{{$address->id}}">
                        </form>
                    @endif
                    
                </div>
                
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
