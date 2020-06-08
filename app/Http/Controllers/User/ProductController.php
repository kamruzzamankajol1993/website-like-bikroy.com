<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Sub_category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAddFromUser;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Auth::user()->products()->latest()->get();
        return view('user.product.manage',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('user.product.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     protected function imageUpload($request){
        $productImage = $request->file('image');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'product-image/';
        $imageUrl = $directory.$imageName;
    
        Image::make($productImage)->resize(540,540)->save($imageUrl);

        return $imageUrl;
    }

     protected function saveProductInfo($request, $imageUrl){
        $product = new Product();
        $product->user_id = Auth::id();
        $product->cat_id = $request->cat_id;
        $product->sub_id = $request->sub_id;
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->price = $request->price;
        $product->location = $request->location;
        $product->condition = $request->condition;
        
        $product->des = $request->des;
        $product->image = $imageUrl;
        $product->save();
        //$users = User::where('role_id','1')->get();
        //Notification::send($users, new NewAddFromUser($product));
       Toastr::success('Product Successfully Saved :)' ,'Success');
        return redirect()->route('user.product');

        }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            
            'name' => 'required', 
            'price' => 'required',
            'location' => 'required',
            'condition' => 'required',
            'des' => 'required',
            'image' => 'required'
            
        ]);

        $imageUrl = $this->imageUpload($request);
        $this->saveProductInfo($request, $imageUrl);

       return redirect()->route('user.product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
         if ($product->user_id != Auth::id()){

            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();

         }
        $product = DB::table('products')
          ->join('categories','categories.id','=','products.cat_id')
          ->join('subcategories','subcategories.id','=','products.sub_id')
          ->select('products.*','categories.name as itemName','subcategories.sub_name')
          ->Where('products.id','=',$id)
          ->first();
          //dd($product);
        return view('user.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function edit($id)
    {

        $product = Product::find($id);
         if ($product->user_id != Auth::id()){

            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();

         }
        $categories = Category::all();
        $product = Product::find($id);
        return view('user.product.edit',['categories' => $categories,'product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productInfoUpdate($product, $request, $imageUrl){
       $product->user_id = Auth::id();
        $product->cat_id = $request->cat_id;
        $product->sub_id = $request->sub_id;
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->price = $request->price;
        $product->location = $request->location;
        $product->condition = $request->condition;
        
        $product->des = $request->des;
        $product->image = $imageUrl;
        $product->save();
    }
    public function update(Request $request)
      {
        $productImage = $request->file('image');
        if($productImage){
            $product = Product::find($request->id);
            unlink($product->image);

            $imageUrl = $this->imageUpload($request);
            $this->productInfoUpdate($product, $request, $imageUrl);

             Toastr::success('Product Successfully Updated :)' ,'Success');
        return redirect()->route('user.product');

        } else {
             $product = Product::find($request->id);
             $product->user_id = Auth::id();
             $product->cat_id = $request->cat_id;
             $product->sub_id = $request->sub_id;
             $product->name = $request->name;
             $product->slug = str_slug($request->name);
             $product->price = $request->price;
             $product->location = $request->location;
             $product->condition = $request->condition;
             $product->des = $request->des;
            
             $product->save();

             Toastr::success('Product Successfully Updated :)' ,'Success');
        return redirect()->route('user.product');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
         if ($product->user_id != Auth::id()){

            Toastr::error('You are not authorized to access this post','Error');
            return redirect()->back();

         }
         Product::find($id)->delete();
         Toastr::success('Product Successfully Deleted :)','Success');
         return redirect()->back();
    }
}
