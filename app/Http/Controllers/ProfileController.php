<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);

        $follow =  (auth()->user()) ? auth()->user()->following->contains($user->id) : false; 

        
        return view('profile.index', [
            'user' => $user,
            'follow' => $follow
        ]);
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
