<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Image;

class AdminProductController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(8);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // all categories for parent selection
         $items = Category::all();
         // all brands for the possibility of choosing a suitable
         $brands = Brand::all();
         return view('admin.product.create', compact('items', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'brand_id' => 'integer',
            'old_price' => 'required|max:100',
            'new_price' => 'required|max:100',
            'in_stock' => '',
            'description' => 'required|max:500',
            'slug' => 'required|max:100|unique:products,slug|alpha_dash',
            'category_id' => 'integer',
        ]);

        
        $product = Product::create($request->all());
        return redirect()
            ->route('admin.product.show', ['product' => $product->id])
            ->with('success', 'New product successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
          // все категории для возможности выбора родителя
          $items = Category::all();
          // все бренды для возмозжности выбора подходящего
          $brands = Brand::all();
          return view('admin.product.edit', compact('product', 'items', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        $product->update($data);
        return redirect()
            ->route('admin.product.show', ['product' => $product->id])
            ->with('success', 'Product successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product successfully deleted!');
    }

    public function addImages(Request $request, $id) {

        $productData = Product::with('images')->select('id', 'title', 'slug')->find($id);


        if($request->isMethod('post')){
            if($request->hasFile('images')){
                $images = $request->file('images');
                foreach($images as $key => $img) {
                    $productImage = new ProductImage;
                    $image_tmp = Image::make($img);
                    $slug = $productData->slug;
                    $extension = $img->getClientOriginalExtension();
                    $imageName = $slug.rand(1,5).".".$extension;

                    $path = 'css/productImages/'.$imageName;
                    Image::make($image_tmp)->resize(520,600)->save($path);
                    $productImage->img = $imageName;
                    $productImage->product_id = $id;
                    $productImage->save();
                }

                return redirect('admin/add-images/'.$id)->with('success', 'Image successfully added!');
            }
        }

        return view('admin.product.addimages', compact('productData'));
    }

    public function deleteImage($id) {
        $productImage = ProductImage::select('img')->where('id', $id)->first();
        $path = 'css/productImages/';
        if(file_exists($path.$productImage->img)) {
            unlink($path.$productImage->img);
        }

        ProductImage::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Image successfully deleted!');
    }

    public function addSizes(Request $request, $id) {
        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach($data['slug'] as $key => $value) {
                if(!empty($value)) {
                    $sizeCheck = Size::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
                    if($sizeCheck > 0) {
                        return redirect()->back()->with('error', 'Size already exists! Please add another size!');                    
                    }
                    $attribute = new Size;
                    $attribute->product_id = $id;
                    $attribute->slug = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->save();                  
                }
            }
          return redirect()->back()->with('success', 'Size(s) successfully added!');
        }

        $productData = Product::find($id);
        return view('admin.product.addsizes', compact('productData'));
    }

    public function editSizes(Request $request, $id) {
        if($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach($data['size_id'] as $key => $siz) {
                if(!empty($siz)) {
                    Size::where(['id'=>$data['size_id'][$key]])->update(['size'=>$data['size'][$key], 'slug'=>$data['slug'][$key]]);
                }
            }
            return redirect()->back()->with('success', 'Size(s) successfully updated!');
        }       
    }

    public function deleteSizes($id) {
        Size::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Size(s) successfully deleted!');
    }
}
