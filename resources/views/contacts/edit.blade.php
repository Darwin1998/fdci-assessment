<!-- resources/views/contacts/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div style="margin-top: 50px;">
        <div class="card" style="max-width: 800px; margin: auto; padding: 20px;">

            <h2 style="text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Edit Contact</h2>

            <form action="{{ route('contacts.update', $contact->getKey()) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $contact->name) }}" required>
                    @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="company">Company:</label>
                    <input type="text" name="company" id="company" class="form-control" value="{{ old('company', $contact->company) }}">
                    @error('company')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $contact->phone) }}" required>
                    @error('phone')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $contact->email) }}" required>
                    @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Update Contact</button>
                </div>
            </form>

        </div>
    </div>
@endsection
