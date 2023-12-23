<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
                Product::create($input);
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
