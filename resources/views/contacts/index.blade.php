<!-- resources/views/contacts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div style="margin-top: 50px;">
        <div style="max-width: 800px; margin: auto;">

            <h2 style="text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Contact List</h2>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Search Bar -->
            <form action="{{ route('contacts.search') }}" method="GET" style="margin-bottom: 20px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Contacts</a>
                </div>

                <div>
                    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add New Contact</a>
                </div>
            </div>


            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                <tr style="background-color: #3498db; color: #fff;">
                    <th style="padding: 10px;">Name</th>
                    <th style="padding: 10px;">Company</th>
                    <th style="padding: 10px;">Phone</th>
                    <th style="padding: 10px;">Email</th>
                    <th style="padding: 10px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;">{{ $contact->name }}</td>
                        <td style="padding: 10px;">{{ $contact->company }}</td>
                        <td style="padding: 10px;">{{ $contact->phone }}</td>
                        <td style="padding: 10px;">{{ $contact->email }}</td>
                        <td style="padding: 10px;">
                            <a href="{{ route('contacts.edit', $contact->getKey()) }}" class="btn btn-warning">Edit</a>

                            <!-- Button for deleting the contact with confirmation -->
                            <button class="btn btn-danger" onclick="showConfirmation('{{ route('contacts.destroy', $contact->getKey()) }}')">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $contacts->links() }}


        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initial load of contacts
            loadContacts('');

            // Attach event handler to search button
            $('#searchButton').on('click', function () {
                const searchTerm = $('#searchInput').val();
                loadContacts(searchTerm);
            });

            // Function to load contacts using AJAX
            function loadContacts(searchTerm) {
                $.ajax({
                    url: '{{ route('contacts.search') }}',
                    type: 'GET',
                    data: { search: searchTerm },
                    success: function (data) {
                        // Update the table with new data
                        $('#contactsTable').html(data);
                    },
                    error: function () {
                        console.error('Failed to load contacts.');
                    }
                });
            }
        });
        function showConfirmation(actionUrl) {
            if (confirm('Are you sure you want to delete this contact?')) {
                // Create a form dynamically
                const form = document.createElement('form');
                form.action = actionUrl;
                form.method = 'POST';
                form.style.display = 'none';

                // Add CSRF token and method spoofing for DELETE
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;

                form.appendChild(methodInput);
                form.appendChild(csrfInput);

                // Append the form to the document body and submit it
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

@endsection
