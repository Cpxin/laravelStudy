<?php

use App\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Staff::truncate();

        $faker = \Faker\Factory::create('zh_CN');
        $position=array('后端工程师','前端工程师','总监','主任','项目组长');
        $sex=array(10,20,30);
        // And now, let's create a few articles in our database:
        DB::statement("ALTER TABLE staff AUTO_INCREMENT = 1000;");
        for ($i = 0; $i < 1000; $i++) {
            Staff::insert([
//                'name' => $faker->addProvider(new \Faker\Provider\zh_CN\Person($faker)),
//                'name'=>$faker->addProvider(new \Faker\Provider\zh_CN\Person()),
                'name'=>$faker->name,
                'age' => array_random([20,22,25,26,30,28,33,31,30,29,27,38,40,39]),
                'sex'=>array_random($sex),
                'position'=>array_random($position),
                'state'=>0,
                'created_at'=>date('Y-m-d H-i-s'),
                'updated_at'=>date('Y-m-d H-i-s'),
            ]);
        }
    }
}
