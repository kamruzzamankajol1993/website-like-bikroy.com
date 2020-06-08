<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\DB;
use App\Product;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        $topcategories=Category::where('status','1')->get();
        $subcategories = Subcategory::all();
        $products =Product::where('is_approved','1')->latest()->take(12)->get();    
        return view('front-end.home.home',['categories'=>$categories,'subcategories'=>$subcategories,'topcategories'=>$topcategories,'products'=>$products]);
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

    public function member()
      {
         $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        $subcategories = Subcategory::all();
        return view('front-end.membership.member',['categories'=>$categories,'subcategories'=>$subcategories]);
    }

    public function contact()
      {
         $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        $subcategories = Subcategory::all();
        return view('front-end.contact.contact',['categories'=>$categories,'subcategories'=>$subcategories]);
    }

     public function about()
      {
         $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        $subcategories = Subcategory::all();
        return view('front-end.about.about',['categories'=>$categories,'subcategories'=>$subcategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
