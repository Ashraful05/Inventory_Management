<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i=1;$i<=5;$i++)
        {
            Customer::create([
               'name'=>$faker->name,
               'mobile_no'=>$faker->phoneNumber,
               'email'=>$faker->email,
               'address'=>$faker->address,
               'status'=>1,
                
            ]);
        }
    }
}
