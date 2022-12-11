<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;



use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    public function getProduct()
    {
        //lấy toàn bộ sản phẩm
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product.list')->with('datas', $products);
    }

    public function addProduct(Request $request)
    {
        //validate giá trị người dùng gửi lên 
        $request->validate([
            'name' => 'required|min:5|max:100',
            'price' => 'required',
            'des' => 'required',
            'qty' => 'required',
            'weight' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,gif,svg|max:10240',
            'slug' => 'required'
        ]);
        if ($request->image) {

            $imageName = uniqid() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('image'), $imageName);
        }
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imageName ?? '',
            'des' => $request->des,
            'qty' => $request->qty,
            'weight' => $request->weight,
            'category_id' => $request->category_id,
            'slug' => $request->slug
        ]);
        return redirect()->route('product.list');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.list');
    }


    public function getDetail($id)
    {
        $product = Product::find($id);
        $productCategories = ProductCategory::all();
        return view('admin.product.edit')
            ->with('productCategories', $productCategories)
            ->with('product', $product);
    }


    public function editProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5|max:10',
            'price' => 'required',
            'des' => 'required',
            'qty' => 'required',
            'weight' => 'required',
            // 'image' => 'required' ?? ''

        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->des = $request->des;
        $product->qty = $request->qty;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;

        if ($request->imagetest) {

            $imageName = uniqid() . '_' . $request->imagetest->getClientOriginalName();
            $request->imagetest->move(public_path('image'), $imageName);

            unlink("image/" . $product->image);
            $product->image = $imageName ?? '';
        }

        $product->save();

        return redirect()->route('product.edit', $product->id)->with('success', 'Edit Successfully');
        // return view('admin.product.edit')->with('product', $product);
    }
    public function getViewProductAdd()
    {
        $productCategories = ProductCategory::all();
        return view('admin.product.add')->with('productCategories', $productCategories);
    }


    public function getSlug(Request $request)
    {
        $name = $request->title;
        //$slug = Str::slug($name);
        // $slug = implode("-", explode(" ", trim($name)));

        $slug = SlugService::createSlug(Product::class, 'slug', $name);
        return response()->json(['slug' => $slug]);
    }
    public function getProductBySlug($slug)
    {
        //dd(session()->get('cart'));
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            //return redirect()->route('frontend.home');
            return abort(404);
        }
        return view('frontend.shop-details')->with('product', $product);
    }


    public function getProductToShop(Request $request)
    {
        $sort = $request->sort;
        $sortBy = [];
        switch ($sort) {
            case 0:
                $sortBy['field'] = 'id';
                $sortBy['sortBy'] = 'desc';
                break;
            case 1:
                $sortBy['field'] = 'price';
                $sortBy['sortBy'] = 'asc';
                break;
            case 2:
                $sortBy['field'] = 'price';
                $sortBy['sortBy'] = 'desc';
                break;
            default:
                $sortBy['field'] = 'id';
                $sortBy['sortBy'] = 'desc';
        }

        $min = $request->min ?? null;
        $max = $request->max ?? null;

        $category = $request->category ?? null;

        $products = Product::where('id', '>', 0);

        if (!is_null($min) && !is_null($max)) {
            $products = Product::whereBetween('price', [$min, $max]);
        }
        if (!is_null($category) && $category !== 'all') {
            $products = $products->where('category_id', $category);
        }

        $products = $products->orderBy($sortBy['field'], $sortBy['sortBy'])->paginate(6);
        $productCategories = ProductCategory::orderBy('name', 'desc')->get()->filter(function ($productCategory) {
            return ($productCategory->getProducts->count() > 0);
        });

        return view('frontend.shop', [
            'products' => $products,
            'min' => Product::min('price'),
            'max' => Product::max('price'),
            'productCategories' => $productCategories,
            'count' => $products->total()
        ]);
        // ->with('productCategories', $productCategories)->with('products', $products);
    }
}
