<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use Validator;

class ColorController extends Controller
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
        $colors=Color::all();
        return view('admin.color',compact('colors'));
    }

    public function getList()
    {
        $color = Color::all();
        return datatables()->of($color)
            ->addColumn('action', function($color){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/color/".$color->id."'> Details</button>
                <button type='button' id=".$color->id." class='btn btn-warning btn-edit' data-url='/admin/color/".$color->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/color/".$color->id."'> Delete</button>";
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
            'description' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
            'description.required' => 'Miêu tả không được để trống',
            'description.max' => 'Miêu tả có tối đa 255 kí tự',
        ]);
        $colors = new Color;
        $colors->name = $request->name;
        $colors->description = $request->description;
        $colors->save();
        return response()->json(['data'=>$colors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colors=Color::find($id);
        return response()->json(['data'=>$colors]);
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
            'description' => 'required|max:255',
        ],[
            'name.required' => 'Tiêu đề không được để trống',
            'name.max' => 'Tiêu đề có tối đa 255 kí tự',
            'description.required' => 'Miêu tả không được để trống',
            'description.max' => 'Miêu tả có tối đa 255 kí tự',
        ]);
        $colors=Color::find($id);
        $colors->name = $request->name;
        $colors->description = $request->description;
        $colors->save();
        return response()->json(['data'=>$colors]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Color::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
