<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::get();
        return view('Dashboard.products.index')->with([
            'products'    => $products,
        ]);
    }

    public function create(){
        $products = Product::get();
        $categories = Category::get();

        return view('Dashboard.products.create')->with([
            'products'    => $products,
            'categories'    => $categories,
        ]);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
                $input = $request->only('name', 'description', 'category_id', 'price');
                $product = Product::create($input);

                if($request->hasfile('image')){
                    $path = $this->uploadImage($request->file('image'), 'uploads/images');
                    Image::create([
                        'imageable_id'   => $product->id,
                        'imageable_type' => 'App\Models\Product',
                        'src'            => $path,
                    ]);
                }
            DB::commit();
            return redirect('dashboard/products')->with('success', 'success');
        } catch(\Exception $ex){
            return $ex;
            return redirect('dashboard/products')->with('error', 'faild');
        }
    }

    public function edit($id){
        $products = Product::get();
        $data = Product::findOrFail($id);
        $categories = Category::get();

        return view('Dashboard.products.edit')->with([
            'products'    => $products,
            'data'  => $data,
            'categories'    => $categories
        ]);
    }

    public function update(Request $request, $id){
        $input = $request->only('name', 'description', 'category_id', 'price');
        $product = Product::findOrFail($id);
        try{
            DB::beginTransaction();
                $product->update($input);

                if($request->hasfile('image')){
                    $path = $this->uploadImage($request->file('image'), 'uploads/images');

                    if($product->Image == null){
                        //if user don't have image 
                        Image::create([
                            'imageable_id'   => $product->id,
                            'imageable_type' => 'App\Models\Product',
                            'src'            => $path,
                        ]);
                    } else {
                        //ig user have image
                        $oldImage = $product->Image->src;
            
                        if(file_exists(base_path('public/uploads/images/') . $oldImage))
                            unlink(base_path('public/uploads/images/') . $oldImage);
            
                        $product->Image->src = $path;
                        $product->Image->save();
                    }
                }

            DB::commit();
            return redirect('dashboard/products')->with('success', 'success');
        } catch(\Exception $ex){
            return redirect('dashboard/products')->with('error', 'faild');
        }
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('dashboard/products')->with('success', 'success');
    }
}
