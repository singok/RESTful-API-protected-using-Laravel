<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as fake;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = fake::create();
        for($i=1;$i<=10;$i++) {
            Employee::insert([
                'fullname' => $info->name,
                'gender' => $info->randomElement(['Male','Female','Other']),
                'age' => $info->numberBetween(18,35),
                'email' => $info->safeEmail,
                'phone' => $info->phoneNumber,
                'address' => $info->address,
                'postcode' => $info->postCode
            ]);
        }
    }
}
