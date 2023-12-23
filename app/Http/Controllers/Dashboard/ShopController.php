<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ShopController extends Controller
{
    public function index(){
        $shops = Shop::get();
        return view('Dashboard.shops.index')->with([
            'shops'    => $shops,
        ]);
    }

    public function create(){
        $shops = Shop::get();
        $products = Product::get();
        return view('Dashboard.shops.create')->with([
            'shops'    => $shops,
            'products'  => $products,
        ]);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
                $input = $request->only('name');

                $shop = Shop::create($input);
                $shop->Products()->sync($request->product_ids);
            DB::commit();
            return redirect('dashboard/shops')->with('success', 'success');
        } catch(\Exception $ex){
            return $ex;
            return redirect('dashboard/shops')->with('error', 'faild');
        }
    }

    public function edit($id){
        $shops = Shop::get();
        $data = Shop::findOrFail($id);
        $products = Product::get();

        return view('Dashboard.shops.edit')->with([
            'shops'    => $shops,
            'data'  => $data,
            'products'  => $products,
        ]);
    }

    public function update(Request $request, $id){

        $input = $request->only('name');
        $shop = Shop::findOrFail($id);
        try{
            DB::beginTransaction();
                $shop->update($input);
                $shop->Products()->sync($request->product_ids);
            DB::commit();
            return redirect('dashboard/shops')->with('success', 'success');
        } catch(\Exception $ex){
            return redirect('dashboard/shops')->with('error', 'faild');
        }
    }

    public function destroy($id){
        $shop = Shop::findOrFail($id);
        $shop->delete();
        return redirect('dashboard/shops')->with('success', 'success');
    }
}
