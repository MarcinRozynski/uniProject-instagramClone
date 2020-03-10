<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);


        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');
            // dd(public_path("$imagePath"));
            $image = Image::make(public_path("storage/$imagePath"))->fit(1000, 1000);
            // dd($imagePath);
            $image->save();
        }


        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => 'storage/' . $imagePath]
        ));

        return redirect("/profile/{$user->id}");
    }
}