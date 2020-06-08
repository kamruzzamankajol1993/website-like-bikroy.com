<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategory;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front-end.category.category');
    }

    //to show subcategory filed in service page
    public function findProductName(Request $request){

        $data=Subcategory::select('sub_name','id')->where('cat_id',$request->id)->get();
        return response()->json($data);
    }


    public function details($id){
        $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        
        $subcategories = Subcategory::all();
        $catid=Subcategory::where('id',$id)->value('cat_id');
        $subcatname=Subcategory::where('id',$id)->value('sub_name');
        $catname=Category::where('id',$catid)->value('name');
        $subcats=Subcategory::where('cat_id',$catid)->get();
        $subproducts = Product::where('sub_id',$id)
                            ->where('is_approved',1)
                            ->get();
        return view('front-end.category.category',['categories'=>$categories,'subcategories'=>$subcategories,'subproducts'=>$subproducts,'catname'=>$catname,'subcats'=>$subcats,'subcatname'=>$subcatname]);

    }

    public function all(){
        $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        
        $subcategories = Subcategory::all();
        //$catid=Subcategory::where('id',$id)->value('cat_id');
        //$subcatname=Subcategory::where('id',$id)->value('sub_name');
        //$catname=Category::where('id',$catid)->value('name');
        //$subcats=Subcategory::where('cat_id',$catid)->get();
        $subproducts = Product::orderBy('id','DESC')->paginate(12);
        return view('front-end.category.all.detail',['categories'=>$categories,'subproducts'=>$subproducts,'subcategories'=>$subcategories]);

    }

     public function maindetails($id){
        $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        
        $subcategories = Subcategory::all();
        //$catid=Subcategory::where('id',$id)->value('cat_id');
        $subcatname=Subcategory::where('cat_id',$id)->value('sub_name');
        $catname=Category::where('id',$id)->value('name');
        $subcats=Subcategory::where('cat_id',$id)->get();
        $subproducts = Product::where('cat_id',$id)
                            ->where('is_approved',1)
                            ->get();
        return view('front-end.category.single-category.detail',['categories'=>$categories,'subcategories'=>$subcategories,'subproducts'=>$subproducts,'catname'=>$catname,'subcats'=>$subcats,'subcatname'=>$subcatname]);

    }

//to show subcategory filed in service page

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
        $categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        
        $subcategories = Subcategory::all();
        $product = DB::table('products')
          ->join('categories','categories.id','=','products.cat_id')
          ->join('users','users.id','=','products.user_id')
          ->select('products.*','categories.name as catName','users.id as Userid','users.name as Username','users.member','users.email','users.phone','users.image as Userimage')
          ->where('is_approved','1')
          ->Where('products.id','=',$id)
          ->first();
          //dd($product);
          $randomposts = Product::where('is_approved','1')->take(3)->inRandomOrder()->get();
        return view('front-end.category.single-product.detail',compact('product','categories','subcategories','randomposts'));
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
