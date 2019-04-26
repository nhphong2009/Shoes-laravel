<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Style;
use Validator;


class StyleController extends Controller
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
        $styles=Style::all();
        return view('admin.style',compact('styles'));
    }

    public function getList()
    {
        $style = Style::all();
        return datatables()->of($style)
            ->addColumn('action', function($style){
                return "<button type='button' class='btn btn-info btn-show' data-url='/admin/style/".$style->id."'> Details</button>
                <button type='button' id=".$style->id." class='btn btn-warning btn-edit' data-url='/admin/style/".$style->id."'> Edit</button>
                <button type='button' class='btn btn-danger btn-delete' data-url='/admin/style/".$style->id."'> Delete</button>";
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
        $styles = new Style;
        $styles->name = $request->name;
        $styles->save();
        return response()->json(['data'=>$styles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $styles=Style::find($id);
        return response()->json(['data'=>$styles]);
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
        $styles=Style::find($id);
        $styles->name = $request->name;
        $styles->save();
        return response()->json(['data'=>$styles]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Style::find($id)->delete();

        return response()->json(['id' => $id]);
    }
}
