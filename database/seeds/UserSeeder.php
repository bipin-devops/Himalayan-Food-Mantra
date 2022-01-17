<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->where('id', 1)->where('username', 'admin')->first()==null) {
            $insertedData['first_name'] = 'mahesh';
            $insertedData['last_name'] = 'karki';
            $insertedData['username'] = 'admin';
            $insertedData['email'] = 'admin@gmail.com';
            $insertedData['status'] = true;
            $insertedData['password'] = bcrypt('admin');
            $insertedData['created_at'] = \Carbon\Carbon::now();
            $this->user->create($insertedData);
        }
    }
}
