<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;


class SupplierSeeder extends Seeder
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
            Supplier::create([
               'name'=>$faker->name,
                'email'=>$faker->email,
                'mobile_no'=>$faker->phoneNumber,
                'address'=>$faker->address,
                'status'=>1
            ]);
        }
    }
}
