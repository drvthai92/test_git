<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ProductCategoryCotroller extends Controller
{
    public function getProductCategory()
    {
        $productCategories = ProductCategory::orderBy('id', 'desc')->get();
        return view('admin.product_category.list')->with('datas', $productCategories);
    }



    public function addProductCategory(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255'
            ]
        );

        $productCategories = ProductCategory::create([
            'name' => $request->name,
        ]);
        return redirect()->route('product_category.list')->with('success', 'Add Cetagory Successful!');
    }
    public function deleteProductCategory($id)
    {
        $productCategory = ProductCategory::find($id);
        $productCategory->delete();
        return redirect()->route('product_category.list')->with('success', 'Delete Successfully');
    }
    public function getSlug(Request $request)
    {
        $name = $request->title;
        //$slug = Str::slug($name);
        // $slug = implode("-", explode(" ", trim($name)));

        $slug = SlugService::createSlug(ProductCategory::class, 'slug', $name);
        return response()->json(['slug' => $slug]);
    }
}
