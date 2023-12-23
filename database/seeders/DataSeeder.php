<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = 1;
        //create main and sub categories
        for($i = 1; $i <= 3;$i++){
            $parent = Category::create([
                            'name'  => 'Main Category ' . $i
                        ]);

            for($c = 1; $c <= 2;$c++){
                Category::create([
                    'name'  => 'Sub Category ' . $s++,
                    'parent_id' => $parent->id
                ]);
            }
        }

        //create shops
        for($i = 1; $i <= 40;$i++){
            Product::create([
                            'name'  => 'Product ' . $i,
                            'description'  => 'description',
                            'category_id'   => Category::inRandomOrder()->first()->id,
                            'price' => rand(100, 1000),
                        ]);
        }

        //create shops
        for($i = 1; $i <= 5;$i++){
            $shop = Shop::create([
                            'name'  => 'shop ' . $i
                        ]);

            $product_ids = Product::inRandomOrder()->limit(3)->pluck('id')->toArray();
            $shop->Products()->sync($product_ids);
        }
    }
}
