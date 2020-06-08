<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Subcategory;
Use App\Category;

class SearchController extends Controller
{
     public function search(Request $request)
    {

    	$categories=Category::where('status','1')
                ->orderBy('id','ASC')
                ->take(11)
                ->get();
        
        $subcategories = Subcategory::all();
        //$catid=Subcategory::where('id',$id)->value('cat_id');
        //$subcatname=Subcategory::where('id',$id)->value('sub_name');
        //$catname=Category::where('id',$catid)->value('name');
        //$subcats=Subcategory::where('cat_id',$catid)->get();
        $search_txt = $request->input('query');
        $products = Product::where('is_approved',1)
                           ->where('name', 'like', '%'.$search_txt.'%')
                ->orWhere('price', 'like', '%'.$search_txt.'%')
                ->orWhere('location', 'like', '%'.$search_txt.'%')
                ->get();
                           
       return view('front-end.search',['categories'=>$categories,'subcategories'=>$subcategories,'products'=>$products,'search_txt'=>$search_txt]);
    }
}
