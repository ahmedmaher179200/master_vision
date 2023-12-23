<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryDetailsRequest;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Product;
use App\View\Components\form\file;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function latestProducts(){
        $latestProducts = Product::whereIn('id', function ($query) {
                                        $query->selectRaw('MAX(id)')
                                            ->from('products')
                                            ->groupBy('category_id');
                                    })
                                    ->with('Category')
                                    ->get();

        return $this->success(
            trans('auth.success'),
            200,
            'data',
            $latestProducts
        );
    }

    public function categoryDetails(CategoryDetailsRequest $reqeust){
        $category = Category::findOrFail($reqeust->category_id);

        return $this->success(
            trans('auth.success'),
            200,
            'data',
            new CategoryResource($category)
        );
    }

    public function order(OrderRequest $request){
        $order = Order::create();

        $total = 0;
        foreach($request->products as $product){
            $productPrice = Product::findOrFail($product['product_id'])->price;
            $total += $product["quantity"] * $productPrice;
            Order_Product::create([
                'product_id' => $product['product_id'],
                'order_id'  => $order->id,
                'quantity' => $product['quantity'],
            ]);
        }

        $order->total = $total;
        $order->save();

        return $this->success(
            trans('auth.success'),
            200
        );
    }
}
