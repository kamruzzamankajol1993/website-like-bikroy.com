<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function index()
    {
         $user = Auth::user();
         $products = $user->products;
         $popular_ads = $user->products()
                   ->withCount('favorite_to_users')
                   ->orderBy('favorite_to_users_count')
                   ->take(5)->get();
        $total_pending_ads = $products->where('is_approved',0)->count();
    	return view('user.dashboard',compact('products','popular_ads','total_pending_ads'));
    }
}
