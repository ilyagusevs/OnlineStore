<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Request;


class ProductController extends Controller
{
    public function showProduct($categ, $slug){
        $product = Product::where('slug',$slug)->first();

        $other_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get();

        return view('product',compact('product', 'other_products'));
    }

    public function showCategoryProduct(Request $request, $categ)
    {    
        $categ_slug = Category::where('slug',$categ)->first();
        $paginate = 6;        
        $products = Product::where('category_id',$categ_slug->id)->paginate($paginate);

        if(Request::get('sort') == 'low-high'){
            $products = Product::where('category_id',$categ_slug->id)->orderBy('new_price', 'asc')->paginate($paginate);
        }elseif(Request::get('sort') == 'high-low'){
            $products = Product::where('category_id',$categ_slug->id)->orderBy('new_price', 'desc')->paginate($paginate);
        }elseif(Request::get('sort') == 'new'){
            $products = Product::where('category_id',$categ_slug->id)->orderBy('created_at', 'desc')->paginate($paginate);
        }

        if(Request::get('filter') == 'nike'){
            $products = Product::where('category_id',$categ_slug->id)->where('brand_b_id', 1)->paginate($paginate);
        }elseif(Request::get('filter') == 'adidas'){
            $products = Product::where('category_id',$categ_slug->id)->where('brand_b_id', 2)->paginate($paginate);
        }elseif(Request::get('filter') == 'reebok'){
            $products = Product::where('category_id',$categ_slug->id)->where('brand_b_id', 3)->paginate($paginate);
        }

        if(Request::get('filter-size') == '38'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '38')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == '39'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '39')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == '40'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '40')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == '41'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '41')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == '42'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '42')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == '43'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '43')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == '44'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '44')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == '44'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', '44')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);

        }elseif(Request::get('filter-size') == 'xs'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', 'XS')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == 'S'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', 'S')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == 'm'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', 'M')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == 'l'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', 'L')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == 'xl'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', 'XL')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }elseif(Request::get('filter-size') == 'one-size'){
            $products = Product::where('category_id',$categ_slug->id)->whereHas('sizes', function($query){
                $query->where('size', 'One size')->where('stock', '>', '0');
            })->with('sizes')->paginate($paginate);
        }
        
        return view('products', compact('categ_slug', 'products'));
    }

    public function search(Request $request) {
        $request::validate([
            'query' => 'required|min:3',
        ]);

        $query = $request::input('query');

        $products = Product::where('products.title', 'like', "%$query%")
        ->orWhere(Product::raw("concat(brands.brand, ' ', products.title)"), 'like', "%$query%")
        ->orWhere('brands.brand', 'like', "%$query%")
        ->join('brands', 'products.brand_b_id', '=', 'brands.b_id')
        ->paginate(6);
        
        return view('search-results', compact('products'));
    }

}