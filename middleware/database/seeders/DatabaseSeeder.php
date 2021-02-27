<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // User::factory()->count(2)->create();
        User::factory()->count(3)->has(Service::factory()->count(3),'service')->create();
        //Service is a model and relationmethod is the one present in user connecting services

    }
}
