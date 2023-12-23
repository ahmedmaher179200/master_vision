<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Product;
use App\Traits\response;
use App\Traits\Upload;
use Exception;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use Upload;
    use response;

    public function products(){
        $products = Product::get();
        return view('products')->with([
            'products'  => $products,
        ]);
    }

    public function cart(){
        if(!session('cart')){
            $cart = [];
            session(['cart' => $cart]);
        }
        $cart_items = session('cart');
        return view('cart')->with([
            'cart_items'    => $cart_items
        ]);
    }

    public function checkout(Request $request){
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

        //clear seesion
        session(['cart' => []]);
        return redirect('/');
    }


    public function addProductToCartAjax(Request $request){
        if(!session('cart')){
            $cart = [];
        } else {
            $cart = session('cart');
        }

        array_push($cart,['product_id' => $request->product_id,'quantity'  => 1]);

        session(['cart' => $cart]);

        return count(session('cart'));
    }

    public function summernote_upload_image(Request $request){
        $path = null;
        if($request->has('file')){
            $path = $this->uploadImage($request->file('file'), 'uploads/images');
        }

        return url('uploads/images/' . $path);
    }
}
