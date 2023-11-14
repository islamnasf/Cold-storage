<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create($this->adminData());
    }
    private function adminData(){
        return[
            'name'=>'admin',
            'phone'=>'01234567890',
            'password'=>Hash::make("11111111"),
            'admin'=>'1',
            'active'=>'1',
            'email_verified_at'=>Carbon::now(),
        ];
    }
}
