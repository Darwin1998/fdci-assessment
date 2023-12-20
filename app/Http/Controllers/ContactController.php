<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contact::class, 'contact');
    }

    public function index(): View
    {
        $user = Auth::user();

        $contacts = $user->contacts()->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    public function create(): View
    {
        return view('contacts.create');
    }

    public function store(ContactRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $validatedData = $request->validated();

        $user->contacts()->create($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Contact $contact): View
    {
        $this->authorize('update', $contact);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        $this->authorize('update', $contact);

        $validatedData = $request->validated();

        $contact->update($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }

    public function search(Request $request): string
    {
        $user = Auth::user();
        $searchTerm = $request->input('search');

        $contacts = $user->contacts()->where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%$searchTerm%")
                ->orWhere('company', 'like', "%$searchTerm%")
                ->orWhere('phone', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%");
        })->paginate(10);

        return view('contacts.index', compact('contacts'))->render();
    }

}
