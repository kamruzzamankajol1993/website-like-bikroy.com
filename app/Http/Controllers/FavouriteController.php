<?php

namespace App\Http\Controllers;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function add($product){

       $user = Auth::user();
        $isFavorite = $user->favorite_products()->where('product_id',$product)->count();

         if ($isFavorite == 0)
        {
            $user->favorite_products()->attach($product);
            Toastr::success('Product successfully added to your favorite list :)','Success');
            return redirect()->back();
        }else{


        	 $user->favorite_products()->detach($product);
            Toastr::success('Product successfully removed form your favorite list :)','Success');
            return redirect()->back();


        }

       
    }
}
