<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator;
use App\Category;
use App\Brand;
use App\Productdetail;
use Auth;
use App\Color;
use App\Size;
use App\Style;
use App\Material;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        $categories=Category::all();
        $brands=Brand::all();
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();
        $styles = Style::all();
        $materials = Material::all();
        return view('admin.product',compact('products', 'categories', 'brands', 'colors', 'sizes', 'styles', 'materials'));
    }

    public function getList()
    {
        $product = Product::all();
        return datatables()->of($product)
            ->addColumn('price', function($product){
                return number_format($product->price);
            })
            ->addColumn('category', function($product){
                return $product->category->name;
            })
            ->addColumn('brand', function($product){
                return $product->brand->name;
            })
            ->addColumn('action', function($product){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/product/".$product->id."'> Details</button>
                <button type='button' id=".$product->id." class='btn btn-warning btn-edit-product' data-url='/admin/product/".$product->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete-product' data-url='/admin/product/".$product->id."'> Delete</button>";
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|max:225',
            'name' => 'required|max:225',
            'slug' => 'required|max:225',
            'price' => 'required|max:225',
            'content' => 'required',
            'description' => 'required|max:225',
            'thumbnail' => 'required',
            'thumbnail.*' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ],[
            'code.required' => 'Code không được để trống',
            'name.required' => 'Name không được để trống',
            'slug.required' => 'Slug không được để trống',
            'price.required' => 'Price không được để trống',
            'content.required' => 'Content không được để trống',
            'description' => 'Description không được để trống',
            'thumbnail.mimes' => 'Hình ảnh phải chuẩn định dạng jpeg,jpg,png,gif',
            'thumbnail.required' => 'Hình ảnh không được để trống',
            'thumbnail.max' => 'Hình ảnh có tối đa 2048KB',
        ]);

        $products = new Product;

        $products->code = $request->code;
        $products->name = $request->name;
        $products->slug = $request->slug;
        $products->price = $request->price;
        $products->sale_price = $request->sale_price;
        $products->category_id = $request->category_id;
        $products->brand_id = $request->brand_id;
        $products->content = $request->content;
        $products->admin_id = Auth::user()->id;
        $products->description = $request->description;

        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            $file->move('storage/images', $image);
            $products->thumbnail = $image;
        }

        $products->save();

        return response()->json(['data'=>$products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $productdetails = $product->productdetails;
        foreach($productdetails as $productdetail)
        {
            $color_name = $productdetail->color;
            $size_name = $productdetail->size;
            $style_name = $productdetail->style;
            $material_name = $productdetail->material;
            $productdetail_quantity = $productdetail->quantity;
            $productdetail_id = $productdetail->id;

        }
        return response()->json(['data'=>$product, 'productdetails' => $productdetails]);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'code' => 'required|max:225',
            'name' => 'required|max:225',
            'slug' => 'required|max:225',
            'price' => 'required|max:225',
            'content' => 'required',
            'description' => 'required|max:225',
            'thumbnail' => 'required',
            'thumbnail.*' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ],[
            'code.requires' => 'Code không được để trống',
            'name.required' => 'Name không được để trống',
            'slug.required' => 'Slug không được để trống',
            'price.required' => 'Price không được để trống',
            'content.required' => 'Content không được để trống',
            'description' => 'Description không được để trống',
            'thumbnail.mimes' => 'Hình ảnh phải chuẩn định dạng jpeg,jpg,png,gif',
            'thumbnail.required' => 'Hình ảnh không được để trống',
            'thumbnail.max' => 'Hình ảnh có tối đa 2048KB',
        ]);

        $product = Product::find($id);

        $product->code = $request->code;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->content = $request->content;
        $product->admin_id = Auth::user()->id;
        $product->description = $request->description;

        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            $file->move('storage/images', $image);
            unlink("storage/images/".$product->thumbnail);
            $product->thumbnail = $image;
        }

        $product->save();

        return response()->json(['data'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
