<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list = array(
        	array(
        		'name' => 'Admin ecom',
        		'email' => 'admin@ecom530.com',
        		'password' => Hash::make('admin123'),
        		'status' => 'active',
        		'role' => 'admin'
        	),
        		array(
        	 	'name' => 'Customer ecom',
        		'email' => 'customer@ecom530.com',
        		'password' => Hash::make('user123'),
        		'status' => 'active',
        		'role' => 'user'
        	),
        		array(
 				'name' => 'Vendor ecom',
        		'email' => 'seller@ecom530.com',
        		'password' => Hash::make('seller123'),
        		'status' => 'active',
        		'role' => 'seller'
        	)
        );

        foreach ($user_list as $user_info) {
        	$user = new User();
        	if($user->where('email', $user_info['email'])->count() > 0){
        		$user = $user->where('email',$user_info['email'])->first();
        	}
        	$user->fill($user_info);
        	$user->save();
        }
    }
}
