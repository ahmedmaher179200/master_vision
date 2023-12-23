<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::tree()->get();
        return view('Dashboard.categories.index')->with([
            'categories'    => $categories,
        ]);
    }

    public function create(){
        $categories = Category::tree(0)->get();

        return view('Dashboard.categories.create')->with([
            'categories'    => $categories,
        ]);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
                $input = $request->only('parent_id', 'name');

                Category::create($input);
            DB::commit();
            return redirect('dashboard/categories')->with('success', 'success');
        } catch(\Exception $ex){
            return $ex;
            return redirect('dashboard/categories')->with('error', 'faild');
        }
    }

    public function edit($id){
        $categories = Category::tree(0)->get();
        $data = Category::findOrFail($id);

        return view('Dashboard.categories.edit')->with([
            'categories'    => $categories,
            'data'  => $data,
        ]);
    }

    public function update(Request $request, $id){
        $input = $request->only('parent_id', 'name');
        $category = Category::findOrFail($id);

        try{
            DB::beginTransaction();
                $category->update($input);
            DB::commit();
            return redirect('dashboard/categories')->with('success', 'success');
        } catch(\Exception $ex){
            return redirect('dashboard/categories')->with('error', 'faild');
        }
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('dashboard/categories')->with('success', 'success');
    }
}
