<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;
use Validator;

class SizeController extends Controller
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
        $sizes=Size::all();
        return view('admin.size',compact('sizes'));
    }

    public function getList()
    {
        $size = Size::all();
        return datatables()->of($size)
            ->addColumn('action', function($size){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/size/".$size->id."'> Details</button>
                <button type='button' id=".$size->id." class='btn btn-warning btn-edit' data-url='/admin/size/".$size->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/size/".$size->id."'> Delete</button>";
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
            'name' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
        ]);
        $sizes = new Size;
        $sizes->name = $request->name;
        $sizes->save();
        return response()->json(['data'=>$sizes]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sizes=Size::find($id);
        return response()->json(['data'=>$sizes]);
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
            'name' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
        ]);
        $sizes=Size::find($id);
        $sizes->name = $request->name;
        $sizes->save();
        return response()->json(['data'=>$sizes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Size::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
