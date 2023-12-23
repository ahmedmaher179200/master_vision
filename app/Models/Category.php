<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
class Category extends Model
{
    use HasFactory, SoftDeletes;
    use HasRecursiveRelationships;
    protected $table = 'categories';
    protected $guarded = [];

    public function getParentKeyName()
    {
        return 'parent_id';
    }

    public function getLocalKeyName()
    {
        return 'id';
    }

    public function getPath(){
        $cats = $this->ancestors()->orderBy('depth', 'ASC')->get();
        $path = '';
        foreach($cats as $cat){
            $path .= '/' . $cat->name . '/' . $this->name;
        }

        return $path;
    }

    public function Products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function SubCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function GetSupCategories(){
        if($this->SubCategories){
            return $this->SubCategories;
        }
        return null;
    }
}
