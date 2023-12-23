<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';

    public $guarded = [];

    public function Products(){
        return $this->belongsToMany(Product::class, 'product_shop', 'shop_id', 'product_id');
    }

    public function getProducts(){
        $text = '';
        if(count($this->Products) > 0){
            foreach($this->Products as $product){
                $text .= $product->name . ' ,<br>';
            }
        }

        return $text;
    }
}
