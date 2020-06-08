<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Subcategory;
use App\Product;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index()
    {

    	 $products =Product::all();
        

         $popular_ads = Product::withCount('favorite_to_users')
                             ->orderBy('favorite_to_users_count','desc')
                            ->take(5)->get();
             $user_count = User::where('role_id',2)->count();
           $active_users = User::where('role_id',2)
                                ->withCount('products')
                                ->withCount('favorite_products')
                                ->orderBy('products_count','desc')
                                ->orderBy('favorite_products_count','desc')
                                ->take(10)->get();
        $category_count = Category::all()->count();
        $subcategory_count = Subcategory::all()->count();
        $total_pending_ads = Product::where('is_approved',0)->count();
        $new_users_today = User::where('role_id',2)
                                ->whereDate('created_at',Carbon::today())->count();
    	return view('admin.dashboard',compact('products','popular_ads','user_count','active_users','total_pending_ads','category_count','subcategory_count','new_users_today'));
    }
}
