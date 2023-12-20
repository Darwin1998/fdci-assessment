<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app')

@section('content')
    <div style="margin-top: 50px;">
        <div style="max-width: 400px; margin: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div style="background-color: #3498db; padding: 20px; color: #fff; text-align: center; font-size: 24px; font-weight: bold;">
                Login
            </div>

            <div style="padding: 20px;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email address</label>
                        <input type="email" style="width: 100%; padding: 8px; box-sizing: border-box;" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')<small style="color: red;">{{ $message }}</small>@enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Password</label>
                        <input type="password" style="width: 100%; padding: 8px; box-sizing: border-box;" id="password" name="password" required>
                        @error('password')<small style="color: red;">{{ $message }}</small>@enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" style="margin-left: 5px;">Remember me</label>
                    </div>

                    <button type="submit" style="background-color: #3498db; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
