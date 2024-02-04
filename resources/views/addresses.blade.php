@extends('layouts.main')

@section('content')
<section class="page-section">
    <div class="container">
        <div class="row ">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Add New Address') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.profile') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Address Line 1') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ @$authUser->first_name }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Address Line 2') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ @$authUser->last_name }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ @$authUser->username }}" required autocomplete="username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ @$authUser->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('ZIP') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ @$authUser->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ @$authUser->email }}" required autocomplete="email">

                                    @error('email')
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
                <div class="card p-3 mb-3">
                    Address line 1
                    <br>
                    Address line 2
                    <br>
                    City,
                    <br>
                    State
                    <br>
                    Country
                    <br>
                    Zip
                    <span class="position-absolute text-success" style="right: 20px;">Default Address</span>
                    {{-- <button class="position-absolute btn btn-primary" style="right: 20px;">Make Default</button> --}}
                </div>
                <div class="card p-3 mb-3">
                    Address line 1
                    <br>
                    Address line 2
                    <br>
                    City,
                    <br>
                    State
                    <br>
                    Country
                    <br>
                    Zip
                    <button class="position-absolute btn btn-primary" style="right: 20px;">Make Default</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
