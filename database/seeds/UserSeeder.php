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

        $registred = Sentinel::registerAndActivate([
            'email'    => 'dev.highlander.bros@gmail.com',
            'password' => 'parana134'
        ]);

        if ($registred) {
            $user = User::find($registred->id);
            $user->first_name = 'Admin';
            $user->save();
        }
    }
}
