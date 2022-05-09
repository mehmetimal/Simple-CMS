<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $users = array(
            array('id' => '1','email' => 'admin@distedavim.com','email_verified_at' => NULL,'password' => '$2y$10$w0Pxzq1WmorHRBSpa64y0.GRf0NHUSMJLt7.igPCbmWl5l8i6a5w.','remember_token' => NULL,'created_at' => '2022-05-09 19:27:19','updated_at' => '2022-05-09 19:27:19')
        );

        User::insert($users);
    }
}
