<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public $guarded = [];

    public function Products(){
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot(["quantity"]);
    }

    public function GetProductsDetails(){
        $text = '';
        if(count($this->Products) > 0){
            foreach($this->Products as $product){
                $text .= $product->name . ' <span style="color: red;">('.$product->pivot->quantity .')</span>,<br>';
            }
        }

        return $text;
    }
}
