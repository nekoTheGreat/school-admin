<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['user_id'=> 4, 'rank'=> 'main'],
            ['user_id'=> 5,  'rank'=> 'main']    
        ];
        foreach($items as $item){
            DB::table('teachers')->insert($item);
        }
    }
}
