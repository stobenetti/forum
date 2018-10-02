<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class FavoritesController extends Controller {

    public function index() {
        $favorites = Favorite::whereUser_id(Auth::id())->get();
        $posts = array();
        foreach ($favorites as $favorite) {
            $posts[] = Post::find($favorite->post_id);
        }
        return view('favorites.index')->with('posts', $posts);
    }

//    public function verify($post_id) {
    public function verify(Request $request) {
        $user_id = Auth::id();
        $post_id = $request->get('post_id');
        $result = Favorite::where(['user_id' => $user_id, 'post_id' => $post_id])->first();
        if ($result == null) {
            $favorite = new Favorite();
            $favorite->user_id = $user_id;
            $favorite->post_id = $post_id;
            $favorite->save();
        }
        else {
            $result->delete();
        }
        return redirect('posts');
    }
}
