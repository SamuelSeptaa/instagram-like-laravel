<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);

        $follow =  (auth()->user()) ? auth()->user()->following->contains($user->id) : false; 
        
        $posts = Cache::remember('count_posts'. $user->id, now()->addSecond(30), function () use ($user) {
            return $user->posts->count();
        });
        $followers = Cache::remember('followers'. $user->id, now()->addSecond(30), function () use ($user) {
            return $user->profile->followers->count();
        });
        $following = Cache::remember('following'. $user->id, now()->addSecond(30), function () use ($user) {
            return $user->following->count();
        });

        return view('profile.index', compact('user', 'follow', 'posts', 'followers', 'following'));
    }

    public function edit(User $id){
        $this->authorize('update', $id->profile);

        return view('profile.edit', compact('id'));
    }

    public function update(User $user){
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        auth()->user()->profile()->update($data);

        return redirect('/profile/'. auth()->user()->id);

    }

    
}
