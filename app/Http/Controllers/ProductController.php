<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($categ, $product_id) {
        $item = Product::where('id', $product_id)->first();

        return view('product', [
            'item' => $item
        ]);
    }

    public function showCategory($categ_alias) {
        $categ = Category::where('alias', $categ_alias)->first();
        

        return view('categories', [
            'categ' => $categ
        ]);
    }        
}
