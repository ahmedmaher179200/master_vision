<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public $guarded = [];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Shops(){
        return $this->belongsToMany(Shop::class, 'product_shop', 'product_id', 'shop_id');
    }
}
