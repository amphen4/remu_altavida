<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_secretary = Role::where('name', 'secretary')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'Usuario Test Secretaria';
        $user->email = 'p@p.p';
        $user->password = bcrypt('secret');
        $user->role_id = $role_secretary->id;
        $user->save();
        

        $user = new User();
        $user->name = 'Usuario Test Administrador';
        $user->email = 'a@a.a';
        $user->password = bcrypt('secret');
        $user->role_id = $role_admin->id;
        $user->save();
        
    }
}
