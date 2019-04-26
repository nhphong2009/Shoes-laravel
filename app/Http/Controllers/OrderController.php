<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Size;
use App\Color;
use Validator;

class OrderController extends Controller
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
        $orders=Order::all();
        $products = Product::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.order',compact('orders', 'products', 'sizes', 'colors'));
    }

    public function getList()
    {
        $orders = Order::all();
        return datatables()->of($orders)
            ->addColumn('action', function($orders){
                return "
                <button type='button' class='btn btn-primary btn-check-order' data-url='/admin/order/check/". $orders->id ."'> Check order</button>
                <button type='button' class='btn btn-info btn-show' data-url='/admin/order/".$orders->id."'> Details</button>
                <button type='button' class='btn btn-warning btn-edit-order' data-url='/admin/order/".$orders->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete-order' data-url='/admin/order/".$orders->id."'> Delete</button>
                ";
            })
            ->toJson();
    }

    public function checkApplyOrder($id)
    {
        $order = Order::find($id);
        $orderdetails = $order->orderdetails;
        foreach($orderdetails as $orderdetail)
        {
            $product_name = $orderdetail->product->name;
            $size_name = $orderdetail->size->name;
            $color_description = $orderdetail->color->description;
            $orderdetail_quantity = $orderdetail->quantity;
            $orderdetail_id = $orderdetail->id;
        }

        return response()->json(['order' => $order]);
    }

    public function checkCancelOrder($id)
    {
        $order = Order::find($id);
        $orderdetails = $order->orderdetails;
        foreach($orderdetails as $orderdetail)
        {
            $product_name = $orderdetail->product->name;
            $size_name = $orderdetail->size->name;
            $color_description = $orderdetail->color->description;
            $orderdetail_quantity = $orderdetail->quantity;
            $orderdetail_id = $orderdetail->id;
        }

        return response()->json(['order' => $order]);
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
            'code' => 'required|max:255',
            'customer_name' => 'required|max:255',
            'customer_mobile' => 'required|max:255',
            'customer_address' => 'required|max:255',
            'status' => 'required|max:255',
        ],[
            'code.required' => 'Mã không được để trống',
            'code.max' => 'Mã có tối đa 255 kí tự',
            'customer_name.required' => 'Tên không được để trống',
            'customer_name.max' => 'Tên có tối đa 255 kí tự',
            'customer_mobile.required' => 'Số điện thoại không được để trống',
            'customer_mobile.max' => 'Số điện thoại có tối đa 255 ký tự',
            'customer_address.required' => 'Địa chỉ không được để trống',
            'customer_address.max' => 'Địa chỉ có tối đa 255 ký tự',
            'status.required' => 'Tình trạng không được để trống',
            'status.max' => 'Tình trạng có tối đa 255 ký tự',
        ]);

        $orders = new Order;
        $orders->code = $request->code;
        $orders->customer_name = $request->customer_name;
        $orders->customer_mobile = $request->customer_mobile;
        $orders->customer_address = $request->customer_address;
        $orders->status = $request->status;

        $orders->save();
        return response()->json(['data'=>$orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        $orderdetails = $order->orderdetails;
        foreach($orderdetails as $orderdetail)
        {
            $product_name = $orderdetail->product->name;
            $size_name = $orderdetail->size->name;
            $color_description = $orderdetail->color->description;
            $orderdetail_quantity = $orderdetail->quantity;
            $orderdetail_id = $orderdetail->id;
        }

        return response()->json(['data'=>$order, 'orderdetails' => $orderdetails, 'size_name' => $size_name, 'color_description' => $color_description]);
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
            'code' => 'required|max:255',
            'customer_name' => 'required|max:255',
            'customer_mobile' => 'required|max:255',
            'customer_address' => 'required|max:255',
            'status' => 'required|max:255',
        ],[
            'code.required' => 'Mã không được để trống',
            'code.max' => 'Mã có tối đa 255 kí tự',
            'customer_name.required' => 'Tên không được để trống',
            'customer_name.max' => 'Tên có tối đa 255 kí tự',
            'customer_mobile.required' => 'Số điện thoại không được để trống',
            'customer_mobile.max' => 'Số điện thoại có tối đa 255 ký tự',
            'customer_address.required' => 'Địa chỉ không được để trống',
            'customer_address.max' => 'Địa chỉ có tối đa 255 ký tự',
            'status.required' => 'Tình trạng không được để trống',
            'status.max' => 'Tình trạng có tối đa 255 ký tự',
        ]);

        $order = Order::find($id);
        $order->code = $request->code;
        $order->customer_name = $request->customer_name;
        $order->customer_mobile = $request->customer_mobile;
        $order->customer_address = $request->customer_address;
        $order->status = $request->status;

        $order->save();
        return response()->json(['data'=>$order]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return response()->json(['id' => $id]);
    }
}
