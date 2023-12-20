<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ContactsFactory extends Factory
{

    protected  $model = Contact::class;
    public function definition(): array
    {
       return [
            'name' => $this->faker->firstName,
            'company' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
           ];
    }
}
