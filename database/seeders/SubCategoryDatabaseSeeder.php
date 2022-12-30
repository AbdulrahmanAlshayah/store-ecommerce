<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::factory(10)->create();

//        Category::factory(10)->create([
//            'parent_id' => $this->getRandomParentId()
//        ]);
    }

//    private function getRandomParentId()
//    {
//       $parent_id =  \App\Models\Category::whereNull('parent_id')->inRandomOrder()->first();
//       return $parent_id;
//    }
}
