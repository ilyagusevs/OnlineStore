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

        return view('product',[
            'product' => $product
        ]);
    }

        public function brand($title) {
            $brands = Brand::where('title', $title)->firstOrFail();
            return view('categories', compact('brands'));
        }


    public function showCategory(Request $request, $categ_slug)
    {    
        $categ = Category::where('slug',$categ_slug)->first();
        $paginate = 4;        
        $products = Product::where('category_id',$categ->id)->paginate($paginate);
        

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high'){
                $products = Product::where('category_id',$categ->id)->orderBy('new_price')->paginate($paginate);
            }
            if($request->orderBy == 'price-high-low'){
                $products = Product::where('category_id',$categ->id)->orderBy('new_price','desc')->paginate($paginate);
            }

        }

        if($request->ajax()){
            return view('ajax.order-by',[
                'products' => $products
            ])->render();
        }

        return view('categories',[
            'categ' => $categ,
            'products' => $products,
        ]);
    }

}