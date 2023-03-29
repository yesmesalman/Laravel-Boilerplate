<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserTypes;
use Database\Seeders\Users;
use Database\Seeders\Plans;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypes::class);
        $this->call(Users::class);
        $this->call(Plans::class);
    }
}
