<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function follow(User $id){
        return auth()->user()->following()->toggle($id->profile);
    }

    public function search(){
        $name = request('name');
        
        $list = User::where('name', 'like', '%'.$name.'%')->whereNotIn('id', [auth()->user()->id])->get();
        // $follow =  (auth()->user()) ? auth()->user()->following->contains($list->id) : false; 
        
        return view('post.user', compact('list'));
    }
}
