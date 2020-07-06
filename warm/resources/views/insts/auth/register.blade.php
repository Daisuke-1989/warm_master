@extends('layouts.insts.app')

@section('content')

<div class="inner">

    <h1 class="greet">Welcome</h1>

</div>

<div class="container">

<p class="heading">Register</p>

    <div class="row">
                    <form method="POST" action="{{ route('register') }}" class="col s12">
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
                                <label for="inst_id" class="col-md-4 col-form-label text-md-right">{{ __('Please enter ID number for your institution') }}</label>

                            
                                <input id="inst_id" type="text" class="form-control @error('inst_id') is-invalid @enderror" name="inst_id" value="{{ old('inst_id') }}" required autocomplete="inst_id" autofocus>

                                @error('inst_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="j_title" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>

                                    <input id="j_title" type="text" class="form-control @error('j_title') is-invalid @enderror" name="j_title" value="{{ old('j_title') }}" required autocomplete="j_title" autofocus>

                                    @error('j_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="row">
                        <div class="input-field col s12">
                            <label for="dept" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                        
                            <input id="dept" type="text" class="form-control @error('dept') is-invalid @enderror" name="dept" value="{{ old('dept') }}" required autocomplete="dept" autofocus>

                            @error('dept')
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
                            <div class="input-field col s6">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                            <div class="input-field col s6">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-submit_i btn-filter">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
</div>
@endsection
