@extends('layouts.app')

@section('content')
<div class="w3-content" style="max-width: 500px;">
    <form method="POST" action="{{ route('register') }}" class="w3-margin">
        <strong class="w3-center w3-large w3-uppercase w3-wide">{{ __('REGISTER') }}</strong>
        @csrf
        @if ($errors->any())
            <div class="w3-panel w3-display-container w3-padding-16 w3-pale-yellow">
                <span onclick="this.parentElement.style.display='none'" class="w3-button w3-hover-pale-yellow w3-hover-text-yellow w3-large w3-display-topright">&times;</span>
                <strong>Warning</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w3-row w3-section">
            <div class="w3-rest">
                <input id="name" type="name" class="w3-input w3-border {{ $errors->has('name') ? 'w3-pale-yellow' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required>
            </div>
            @if ($errors->has('name'))
                <div class="w3-rest w3-text-yellow" role="alert">
                    <span>{{ $errors->first('name') }}</span>
                </div>
            @endif
        </div>
        <div class="w3-row w3-section">
            <div class="w3-rest">
                <input id="email" type="email" class="w3-input w3-border {{ $errors->has('email') ? 'w3-pale-yellow' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required>
            </div>
            @if ($errors->has('email'))
                <div class="w3-rest w3-text-yellow" role="alert">
                    <span>{{ $errors->first('email') }}</span>
                </div>
            @endif
        </div>
        <div class="w3-row w3-section">
            <div class="w3-rest">
                <input id="password" type="password" class="w3-input w3-border {{ $errors->has('password') ? 'w3-pale-yellow' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
            </div>
            @if ($errors->has('password'))
                <div class="w3-rest w3-text-yellow" role="alert">
                    <span>{{ $errors->first('password') }}</span>
                </div>
            @endif
        </div>
        <div class="w3-row w3-section">
            <div class="w3-rest">
                <input id="password-confirm" type="password" class="w3-input w3-border" name="password_confirmation" placeholder="{{ __('Password Confirmation') }}" required>
            </div>
        </div>
        <div class="w3-row w3-section w3-center">
            <button type="submit" class="w3-button w3-cyan w3-text-white w3-hover-light-blue w3-hover-text-white w3-padding" style="min-width: 100px">{{ __('Register') }}</button>
        </div>
    </form>
    <div class="w3-center">
        <a class="btn btn-link" href="{{ route('login') }}">{{ __('Have an Account? Login here') }}</a>
    </div>
</div>
@endsection
