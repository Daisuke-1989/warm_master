@extends('layouts.students.app')

@section('content')

<div class="inner">

    <h1 class="greet">Welcome</h1>

</div>

<div class="container">
<p class="heading">Register</p>

    <div class="row">
                    <form method="POST" action="{{ route('studentRegister') }}" class="col s12">
                        @csrf

                        <div class="row">
                        <div class="input-field col s6">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="input-field col s6">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                        <div class="input-field col s12">
                            <label for="nations_id" class="col-md-4 col-form-label text-md-right">{{ __('Your country') }}</label>

                            
                                <input id="nations_id" type="text" class="form-control @error('nations_id') is-invalid @enderror" name="nations_id" value="{{ old('nations_id') }}" required autocomplete="nations_id" autofocus>

                                @error('nations_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                        <div class="input-field col s12">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Which year are you planning to start your study?') }}</label>

                                <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" required autocomplete="year" autofocus>

                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                        <div class="input-field col s12">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                        <div class="input-field col s12">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                        <div class="input-field col s12">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-filter btn-submit">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
    </div>
</div>
@endsection
