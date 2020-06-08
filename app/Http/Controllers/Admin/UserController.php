<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
     public function index()
    {
       $users = User::users()
           ->withCount('products')
          
           ->get();
       return view('admin.users.manage',compact('users'));
    }

    public function destroy($id)
    {
        $author = User::findOrFail($id)->delete();
        Toastr::success('Author Successfully Deleted','Success');
        return redirect()->back();
    }

}
