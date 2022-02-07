<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('post.create');
    }

    public function store(){
        $r = request()->validate([
            'title' => 'required',
            'images' => 'required|image',
        ]);

        $imagePath = request('images')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);

        $image->save();
        auth()->user()->posts()->create([
            'title' => $r['title'],
            'images' => $imagePath,
        ]);
        return redirect('/profile/'. auth()->user()->id);
    }

    public function post(post $post){
        return view('post.show', [
            'post' => $post
        ]);
    }

    public function indexes(){

        $user = auth()->user()->following()->pluck('profiles.user_id');

        $posts = post::whereIn('user_id', $user)->latest()->paginate(5);

        // dd($posts);
        return view('post.indexes', compact('posts'));
    }
  
}
