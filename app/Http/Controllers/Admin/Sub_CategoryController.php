<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Subcategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class Sub_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $subcategories = DB::table('subcategories')
          ->join('categories','categories.id','=','subcategories.cat_id')
          ->select('subcategories.*','categories.name')->get();
        return view('admin.sub_category.manage',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
         return view('admin.sub_category.add',compact('categories'));
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
            'sub_name' => 'required',
            'cat_id' => 'required',
            'status' => 'required'
        ]);
        $subcategory = new Subcategory();
        $subcategory->sub_name = $request->sub_name;
        $subcategory->cat_id = $request->cat_id;
        $subcategory->status =  $request->status;
        $subcategory->save();
        Toastr::success('Sub_Category Successfully Saved :)' ,'Success');
        return redirect()->route('admin.subcategory');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        return view('admin.sub_category.edit',['categories' => $categories,'subcategory'=>$subcategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $subcategory = SubCategory::find($request->id);
        $subcategory->sub_name = $request->sub_name;
        $subcategory->cat_id = $request->cat_id;
        $subcategory->status =  $request->status;
        $subcategory->save();
        Toastr::success('Sub_Category Successfully Updated :)','Success');
        return redirect()->route('admin.subcategory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::find($id)->delete();
         Toastr::success('Sub_Category Successfully Deleted :)','Success');
         return redirect()->back();
    }
}
