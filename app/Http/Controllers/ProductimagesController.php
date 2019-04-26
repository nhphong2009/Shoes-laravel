<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Productimage;
use App\Product;

class ProductimagesController extends Controller
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
        $productimages=Productimage::all();
        $products=Product::all();
        return view('admin.productimage',compact('productimages', 'products'));
    }

    public function getList()
    {
        $productimage = Productimage::all();
        return datatables()->of($productimage)
            ->addColumn('product', function($productimage){
                return $productimage->product->name;
            })
            ->addColumn('action', function($productimage){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/productimage/".$productimage->id."'> Details</button>
                <button type='button' id=".$productimage->id." class='btn btn-warning btn-edit' data-url='/admin/productimage/".$productimage->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/productimage/".$productimage->id."'> Delete</button>";
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
            'link' => 'required',
            'link.*' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ],[
            'link.mimes' => 'Hình ảnh phải chuẩn định dạng jpeg,jpg,png,gif',
            'link.required' => 'Hình ảnh không được để trống',
            'link.max' => 'Hình ảnh có tối đa 2048KB',
        ]);

        if($request->hasFile('link'))
        {
            foreach($request->link as $link)
            {
                $fileName = $link->getClientOriginalName();

                $image = str_random(4)."_".$fileName;

                $link->move('storage/images', $image);

                $productimages = new Productimage;

                $productimages->product_id = $request->product_id;

                $productimages->link = $image;

                $productimages->save();
            }
        }

        return response()->json(['data'=>$productimages]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productimage=Productimage::find($id);
        $product_name = $productimage->product->name;
        return response()->json(['data'=>$productimage, 'product_name' => $product_name]);
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
            'link' => 'required',
            'link.*' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ],[
            'link.mimes' => 'Hình ảnh phải chuẩn định dạng jpeg,jpg,png,gif',
            'link.required' => 'Hình ảnh không được để trống',
            'link.max' => 'Hình ảnh có tối đa 2048KB',
        ]);

        $productimages = Productimage::find($id);

        $productimages->product_id = $request->product_id;

        if($request->hasFile('link')){
            $file = $request->file('link');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            $file->move('storage/images', $image);
            unlink("storage/images/".$productimages->link);
            $productimages->link = $image;
        }

        $productimages->save();

        return response()->json(['data'=>$productimages]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productimage::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
