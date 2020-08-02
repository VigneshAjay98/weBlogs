<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use App\Post;

class UserController extends Controller
{
public function getProfile()
{
    $posts = Post::orderBy('created_at', 'desc')->get();
    return view('profile', array('user' => Auth::User()) )->withPosts($posts);
}

public function update_avatar(Request $request)
{
    if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time().'.'.$avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/'.$filename));

        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
    }
    // return view('profile', ['user' => Auth::User()]);
    return redirect()->route('getProfile');
}

public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}

}
