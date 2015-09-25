<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $registred = User::create([
            'name'     => 'Admin',
            'email'    => 'dev.highlander.bros@gmail.com',
            'password' => bcrypt('parana134')
        ]);
    }
}
