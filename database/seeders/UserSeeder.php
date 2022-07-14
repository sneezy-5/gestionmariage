<?php

namespace Database\Seeders;
use App\Models\Roles;
use App\Models\User;
use App\Models\Permissions;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [        
            'name'  => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ];
        $admin = 
            ['name'  => 'Admin','email' => 'admin@admin.com','password' =>bcrypt('password')];

           $admin2 = ['name'  => 'Editor','email' => 'editor@editor.com','password' =>bcrypt('password')];
           $admin3 = ['name'  => 'Author','email' => 'author@author.com','password' =>bcrypt('password')];
        
       User::create($user);

        
        User::create($admin);
        User::create($admin2);
        User::create($admin3);

        Roles::create(['name'=>'Editor','slug'=>'editor']);
        Roles::create( ['name'=>'Author','slug'=>'author']);
        Roles::create(['name'=>'Admin','slug'=>'admin']);
        Roles::create(['name'=>'OWNER','slug'=>'OWNER']);
        Roles::create(['name'=>'TENANT','slug'=>'TENANT']);
        Roles::create(['name'=>'CONCIERGE','slug'=>'CONCIERGE']);
        Roles::create(['name'=>'STAFF','slug'=>'STAFF']);
        
        $permission2 =  ['uuid'=>Str::uuid(),'name'=>'Delete Post','slug'=>'delete-post'];
        Permissions::create(
            ['uuid'=>Str::uuid(),'name'=>'Add Post','slug'=>'add-post'],
        );
        Permissions::create($permission2);
        $role_id = Roles::where('name','Admin')->first()->uuid;
        // Assign Role 
        User::where('name','Admin')->first()->roles()->attach([$role_id]);
        // User::whereId(3)->first()->roles()->attach([2]);
        // User::whereId(4)->first()->roles()->attach([3]);
        
        // User::whereId(1)->first()->roles()->attach([4]);
        
        $permission_id = Permissions::where('name','Add Post')->first()->uuid;
        $permission_id_del = Permissions::where('name','Delete Post')->first()->uuid;
        // Role has Permission
        Roles::where('name','Admin')->first()->permissions()->attach([$permission_id, $permission_id_del]);
        // Role::whereId(2)->first()->permissions()->attach([1]);
        // Role::whereId(3)->first()->permissions()->attach([1]);

    }
}