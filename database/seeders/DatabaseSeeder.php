<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ContactsFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $user1 =  UserFactory::new()->createOne([
            'name' => 'sample',
            'email' => 'sample@email.com',
            'password' => Hash::make('password'),
        ]);
        $user2 =  UserFactory::new()->createOne([
            'name' => 'sample2',
            'email' => 'sample2@email.com',
            'password' => Hash::make('password'),
        ]);
        ContactsFactory::new()->count(50)->create([
            'user_id' => $user1->getKey(),
        ]);
        ContactsFactory::new()->count(30)->create([
            'user_id' => $user2->getKey(),
        ]);

    }
}
