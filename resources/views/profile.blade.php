@extends('layouts.app')

@section('content')

<div class="w3-container" style="margin-top: 20px;">
    @if(session()->get('success'))
        <div class="w3-panel w3-display-container w3-padding-16 w3-light-blue w3-text-white">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-hover-light-blue w3-hover-text-blue w3-large w3-display-topright">&times;</span>
            <strong>{{ session()->get('success') }}</strong>
        </div>
    @elseif ($errors->any())
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
    <div class="w3-third">
        <div class="w3-row w3-row-padding">
            <div class="w3-margin w3-center">
                <img src="{{ $profile->profile_picture==null ? asset('img/no_avatar.jpg') : $profile->profile_picture }}" class="w3-image w3-circle">
                <form method="POST" action="{{ route('profile.update', Auth::id()) }}" enctype="multipart/form-data" id="formPicture">
                    @csrf
                    @method('PATCH')
                    <label class="w3-button w3-white w3-block w3-border w3-margin-top" for="profilePicture">Upload</label>
                    <input type="file" name="picture" id="profilePicture" accept="image/x-png,image/gif,image/jpeg" style="display: none;" onchange="event.preventDefault();document.getElementById('formPicture').submit();">
                </form>
            </div>
        </div>
    </div>
    <div class="w3-twothird w3-row-padding">
        <form method="POST" action="{{ route('profile.update', Auth::id()) }}">
            @csrf
            @method('PATCH')
            <div class="w3-row w3-section">
                <div class="w3-rest">
                    <input id="name" type="text" class="w3-input w3-border {{ $errors->has('name') ? 'w3-pale-yellow' : '' }}" name="name" value="{{ (old('name')) ? old('name') : $profile->name }}" placeholder="{{ __('Name') }}" required>
                </div>
                @if ($errors->has('name'))
                    <div class="w3-rest w3-text-yellow" role="alert">
                        <span>{{ $errors->first('name') }}</span>
                    </div>
                @endif
            </div>
            <div class="w3-row w3-section">
                <div class="w3-rest">
                    <input id="email" type="email" class="w3-input w3-border {{ $errors->has('email') ? 'w3-pale-yellow' : '' }}" name="email" value="{{ (old('email')) ? old('email') : $profile->email }}" placeholder="{{ __('Email') }}" required>
                </div>
                @if ($errors->has('email'))
                    <div class="w3-rest w3-text-yellow" role="alert">
                        <span>{{ $errors->first('email') }}</span>
                    </div>
                @endif
            </div>
            <div class="w3-row w3-section">
                <div class="w3-rest">
                    <input id="password" type="password" class="w3-input w3-border {{ $errors->has('password') ? 'w3-pale-yellow' : '' }}" name="password" placeholder="{{ __('Change Password') }}">
                </div>
                @if ($errors->has('password'))
                    <div class="w3-rest w3-text-yellow" role="alert">
                        <span>{{ $errors->first('password') }}</span>
                    </div>
                @endif
            </div>
            <div class="w3-row w3-section">
                <div class="w3-rest">
                    <input id="password-confirm" type="password" class="w3-input w3-border" name="password_confirmation" placeholder="{{ __('Confirmation Password') }}">
                </div>
            </div>
            <div class="w3-row w3-section w3-center">
                <button type="submit" class="w3-button w3-cyan w3-text-white w3-hover-light-blue w3-hover-text-white w3-padding" style="min-width: 100px">{{ __('Save') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
