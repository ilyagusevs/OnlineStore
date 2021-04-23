<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct($categ, $slug){
        $product = Product::where('slug',$slug)->first();

        $other_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get();

        return view('product',compact('product', 'other_products'));
    }

    public function products($id) {
        $products = Product::where('category_id', $id);

        return view('product', compact('products'));
    }

    public function brand($title) {
        $brands = Brand::where('title', $title)->firstOrFail();

        return view('products', compact('brands'));
    }



    public function showCategoryProduct(Request $request, $categ)
    {    
        $categ_slug = Category::where('slug',$categ)->first();
        $paginate = 6;        
        $products = Product::where('category_id',$categ_slug->id)->paginate($paginate);
        

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high'){
                $products = Product::where('category_id',$categ_slug->id)->orderBy('new_price')->paginate($paginate);
            }
            if($request->orderBy == 'price-high-low'){
                $products = Product::where('category_id',$categ_slug->id)->orderBy('new_price','desc')->paginate($paginate);
            }

        }

        if($request->ajax()){
            return view('ajax.order-by',[
                'products' => $products
            ])->render();
        }

        return view('products', compact('categ_slug', 'products'));
    }

    

}