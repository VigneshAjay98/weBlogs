<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Post;
use App\Like;

class PostController extends Controller
{
    public function index()
    {
        return redirect('/profile');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:posts',
            'body' => 'required|max:255'
        ]);
        $post = new Post();
        $post->title = $request['title'];
        $post->body = $request['body'];
        $request->user()->posts()->save($post);

        return redirect()->route('getProfile');
    }

    public function destroy($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('getProfile');
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] == 'true';
        $update = false;
        $post = Post::find($post_id);
        if(!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if($like) {
            $already_like = $like->like;
            $update = true;
            if($already_like == $is_like) {
                $like->delete();
                return null;
            }
        }
        else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if($update) {
            $like->update();
        }
        else {
            $like->save();
        }
        return null;
    }

}
