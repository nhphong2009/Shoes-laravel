<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productdetail;
use Validator;
use App\Product;
use App\Color;
use App\Size;
use App\Style;
use App\Material;

class ProductdetailsController extends Controller
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
        $productdetails = Productdetail::all();
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();
        $styles = Style::all();
        $materials = Material::all();
        return view('admin.productdetail',compact('productdetails', 'products', 'colors', 'sizes', 'styles', 'materials'));
    }

    public function getList()
    {
        $productdetail = Productdetail::all();
        return datatables()->of($productdetail)
            ->addColumn('product', function($productdetail){
                return $productdetail->product->name;
            })
            ->addColumn('color', function($productdetail){
                return $productdetail->color->name;
            })
            ->addColumn('size', function($productdetail){
                return $productdetail->size->name;
            })
            ->addColumn('style', function($productdetail){
                return $productdetail->style->name;
            })
            ->addColumn('material', function($productdetail){
                return $productdetail->material->name;
            })
            ->addColumn('action', function($productdetail){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/productdetail/".$productdetail->id."'> Details</button>
                <button type='button' id=".$productdetail->id." class='btn btn-warning btn-edit-productdetail' data-url='/admin/productdetail/".$productdetail->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete-productdetail' data-url='/admin/productdetail/".$productdetail->id."'> Delete</button>";
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
            'quantity' => 'required',
        ],[
            'quantity.required' => 'Quantity không được để trống',
        ]);

        $productdetails = new Productdetail;

        $productdetails->product_id = $request->product_id;
        $productdetails->color_id = $request->color_id;
        $productdetails->size_id = $request->size_id;
        $productdetails->style_id = $request->style_id;
        $productdetails->material_id = $request->material_id;
        $productdetails->quantity = $request->quantity;

        $productdetails->save();

        $color_name = $productdetails->color->name;
        $size_name = $productdetails->size->name;
        $style_name = $productdetails->style->name;
        $material_name = $productdetails->material->name;

        return response()->json(['data'=>$productdetails, 'color_name' => $color_name, 'size_name' => $size_name, 'style_name' => $style_name, 'material_name' => $material_name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productdetail=Productdetail::find($id);
        $product_name = $productdetail->product->name;
        $color_name = $productdetail->color->name;
        $size_name = $productdetail->size->name;
        $style_name = $productdetail->style->name;
        $material_name = $productdetail->material->name;
        return response()->json(['data'=>$productdetail, 'product_name' => $product_name, 'color_name' => $color_name, 'size_name' => $size_name, 'style_name' => $style_name, 'material_name' => $material_name]);
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
            'quantity' => 'required',
        ],[
            'quantity.required' => 'Quantity không được để trống',
        ]);

        $productdetail = Productdetail::find($id);

        $productdetail->product_id = $request->product_id;
        $productdetail->color_id = $request->color_id;
        $productdetail->size_id = $request->size_id;
        $productdetail->style_id = $request->style_id;
        $productdetail->material_id = $request->material_id;
        $productdetail->quantity = $request->quantity;

        $productdetail->save();

        $color_name = $productdetail->color->name;
        $size_name = $productdetail->size->name;
        $style_name = $productdetail->style->name;
        $material_name = $productdetail->material->name;

        return response()->json(['data'=>$productdetail, 'color_name' => $color_name, 'size_name' => $size_name, 'style_name' => $style_name, 'material_name' => $material_name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productdetail::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
