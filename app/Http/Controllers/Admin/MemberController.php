<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::where('member',0)->get();
       return view('admin.member.manage',compact('users'));
    }
public function approvemember()
    {
       $users = User::where('member',3)->get();
       return view('admin.approve.member.manage',compact('users'));
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
        $author = User::findOrFail($id)->delete();
        Toastr::success('Author Successfully Deleted','Success');
        return redirect()->back();
    }

    public function approval($id)
              {
        $product = User::find($id);
        if ($product->member == 0)
           {
            $product->member = 3;
            $product->save();
            //$product->user->notify(new UserAddApproved($product));
             //$subscribers = Subscriber::all();
        //foreach ($subscribers as $subscriber)
        //{
            //Notification::route('mail',$subscriber->email)
                //->notify(new NewAdNotify($product));
        //}
            //Toastr::success('Product Successfully Approved :)','Success');
            
           //}else{
               //Toastr::info('Product Successfully Approved :)','Info');

           }
           return redirect()->back();
    }
}
