
@extends('layouts.app')

@section('content')
    <div style="margin-top: 50px;">
        <div class="card" style="max-width: 800px; margin: auto; padding: 20px;">

            <h2 style="text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Add New Contact</h2>

            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="company">Company:</label>
                    <input type="text" name="company" id="company" class="form-control">
                    @error('company')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Add Contact</button>
                </div>
            </form>

        </div>
    </div>
@endsection
