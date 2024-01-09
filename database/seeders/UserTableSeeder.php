<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop_owner = new User();
        $shop_owner->name = 'Jon';
        $shop_owner->email = 'jon@admin.com';
        $shop_owner->password = 'HorsePrediction2021';
        $shop_owner->save();
    }
}
