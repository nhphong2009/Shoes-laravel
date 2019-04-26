<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Order;
use App\Orderdetail;
use App\Product;
use App\Color;
use App\Size;

class OrderdetailsController extends Controller
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
        $orders=Order::all();
        $orderdetails=Orderdetail::all();
        $sizes=Size::all();
        $colors=Color::all();
        return view('admin.orderdetail',compact('products', 'orders', 'orderdetails', 'sizes', 'colors'));
    }

    public function getList()
    {
        $orderdetails = Orderdetail::all();
        return datatables()->of($orderdetails)
            ->addColumn('order', function($orderdetails){
                return $orderdetails->order->code;
            })
            ->addColumn('product', function($orderdetails){
                return $orderdetails->product->name;
            })
            ->addColumn('size', function($orderdetails){
                return $orderdetails->size->name;
            })
            ->addColumn('color', function($orderdetails){
                return $orderdetails->color->description;
            })
            ->addColumn('action', function($orderdetails){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/orderdetail/".$orderdetails->id."'> Details</button>
                <button type='button' id=".$orderdetails->id." class='btn btn-warning btn-edit-orderdetail' data-url='/admin/orderdetail/".$orderdetails->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete-orderdetail' data-url='/admin/orderdetail/".$orderdetails->id."'> Delete</button>";
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
            'quantity' => 'required|max:225',
        ],[
            'quantity.required' => 'Số lượng không được để trống',
        ]);

        $orderdetails = new Orderdetail;

        $orderdetails->order_id = $request->order_id;
        $orderdetails->product_id = $request->product_id;
        $orderdetails->quantity = $request->quantity;
        $orderdetails->size_id = $request->size_id;
        $orderdetails->color_id = $request->color_id;

        $orderdetails->save();

        $order_code = $orderdetails->order->code;
        $product_name = $orderdetails->product->name;
        $size_name = $orderdetails->size->name;
        $color_description = $orderdetails->color->description;

        return response()->json(['data'=>$orderdetails, 'order_code' => $order_code, 'product_name' => $product_name, 'size_name' => $size_name, 'color_description' => $color_description]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderdetail=Orderdetail::find($id);
        $product_name = $orderdetail->product->name;
        $order_code = $orderdetail->order->code;
        $size_name = $orderdetail->size->name;
        $color_description = $orderdetail->color->description;
        return response()->json(['data'=>$orderdetail, 'product_name' => $product_name, 'order_code' => $order_code, 'size_name' => $size_name, 'color_description' => $color_description]);
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
            'quantity' => 'required|max:225',
        ],[
            'quantity.required' => 'Code không được để trống',
        ]);

        $orderdetails = Orderdetail::find($id);

        $orderdetails->order_id = $request->order_id;
        $orderdetails->product_id = $request->product_id;
        $orderdetails->quantity = $request->quantity;
        $orderdetails->size_id = $request->size_id;
        $orderdetails->color_id = $request->color_id;

        $orderdetails->save();

        $order_code = $orderdetails->order->code;
        $product_name = $orderdetails->product->name;
        $size_name = $orderdetails->size->name;
        $color_description = $orderdetails->color->description;

        return response()->json(['data'=>$orderdetails, 'order_code' => $order_code, 'product_name' => $product_name, 'size_name' => $size_name, 'color_description' => $color_description]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Orderdetail::find($id)->delete();

        return response()->json(['id' => $id]);   
    }
}
