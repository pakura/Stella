<?php

use Illuminate\Support\Facades\DB;

class CmsUsersTableSeeder extends DatabaseSeeder
{
    /**
     * Run cms_users table seeder.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');

        DB::table('cms_users')->truncate();

        DB::table('cms_users')->insert([
            [
                'email' => 'vajasin@gmail.com',
                'first_name' => 'Vaja',
                'last_name' => 'Sinauridze',
                'role' => 'admin',
                'blocked' => 0,
                'password' => '$2y$10$SGapfDy0uRJPxGD/KV0BaeW5YiP4tNN2kSFkEtvSA1P1t0AUX51oq', // 123456
                'created_at' => $currentDate
            ]
        ]);

        DB::table('cms_settings')->truncate();

        DB::table('cms_settings')->insert([
            [
                'cms_user_id' => 1,
                'created_at'  => $currentDate
            ]
        ]);

        DB::table('web_settings')->truncate();

        DB::table('web_settings')->insert([
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }
}
