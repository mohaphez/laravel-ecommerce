<?php

use App\Role;
use App\Setting;
use App\User;
use Illuminate\Database\Seeder;

class InitialSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'علی';
        $user->family = 'احمدی';
        $user->email = 'admin@example.com';
        $user->nationalCode = '1111111111';
        $user->password = bcrypt('password');
        $user->save();

        $role = new Role();
        $role->name = "مدیریت";
        $role->slug = "مدیریت";
        $role->permissions = '{"admin-panel":true,"see-setting":true,"see-checkout":true,"see-category":true,"create-category":true,"see-order":true,"edit-category":true,"remove-category":true,"see-menu":true,"create-menu":true,"edit-menu":true,"remove-menu":true,"see-user":true,"see-user-details":true,"remove-user":true,"see-product":true,"create-product":true,"edit-product":true,"remove-product":true,"see-product-image":true,"remove-product-image":true,"see-item":true,"create-item":true,"edit-item":true,"remove-item":true,"create-post":true,"see-widget":true,"see-slide":true,"create-slide":true,"edit-slide":true,"remove-slide":true,"see-baner":true,"create-baner":true,"see-post":true,"delete-post":true,"create-comment":true,"see-message":true,"create-message":true,"see-comment":true,"see-depot":true,"see-codes":true}';
        $role->save();

        $user->roles()->attach($role);

        $setting = new Setting();
        $setting->status = 1;
        $setting->save();
    }
}
