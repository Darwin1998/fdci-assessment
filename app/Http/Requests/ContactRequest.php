<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        $user = auth()->user();
        $contactId = $this->route('contact');

        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => [
                Rule::unique('contacts')->where(function ($query) use ($user) {
                // Check for uniqueness within the context of the current user
                return $query->where('user_id', $user->getKey());
            })->ignore($contactId)
            ],
            'company' => 'string'
        ];
    }
}
