<?php


namespace App\Http\Controllers;

use App\Models\category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function getAllCategories()
    {

        $categories = category::orderBy('id', 'desc')->paginate(1);
        $categories = category::find(3); //id cua bang categories xem co may bai viet
        dd($categories->posts);



        return view('enduser.category', compact('categories'));
    }
}
