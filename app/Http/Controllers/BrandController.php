<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Validator;

class BrandController extends Controller
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
        $brands=Brand::all();
        return view('admin.brand',compact('brands'));
    }

    public function getList()
    {
        $brand = Brand::all();
        return datatables()->of($brand)
            ->addColumn('action', function($brand){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/brand/".$brand->id."'> Details</button>
                <button type='button' id=".$brand->id." class='btn btn-warning btn-edit' data-url='/admin/brand/".$brand->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/brand/".$brand->id."'> Delete</button>";
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
            'slug' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn có tối đa 255 kí tự',
        ]);
        $brands = new Brand;
        $brands->name = $request->name;
        $brands->slug = $request->slug;
        $brands->save();
        return response()->json(['data'=>$brands]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brands=Brand::find($id);
        return response()->json(['data'=>$brands]);
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
            'slug' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn có tối đa 255 kí tự',
        ]);
        $brand=Brand::find($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->save();
        return response()->json(['data'=>$brand]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
