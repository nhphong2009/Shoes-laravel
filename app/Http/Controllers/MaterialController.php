<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use Validator;

class MaterialController extends Controller
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
        $materials=Material::all();
        return view('admin.material',compact('materials'));
    }

    public function getList()
    {
        $material = Material::all();
        return datatables()->of($material)
            ->addColumn('action', function($material){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/material/".$material->id."'> Details</button>
                <button type='button' id=".$material->id." class='btn btn-warning btn-edit' data-url='/admin/material/".$material->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/material/".$material->id."'> Delete</button>";
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
        $materials = new Material;
        $materials->name = $request->name;
        $materials->save();
        return response()->json(['data'=>$materials]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materials=Material::find($id);
        return response()->json(['data'=>$materials]);
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
        $materials=Material::find($id);
        $materials->name = $request->name;
        $materials->save();
        return response()->json(['data'=>$materials]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Material::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
