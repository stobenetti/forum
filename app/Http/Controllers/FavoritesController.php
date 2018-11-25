<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Favorite;
use App\Post;

class FavoritesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_id = $_COOKIE['user_id'];
        $favorites = Favorite::whereUser_id($user_id)->get();
        $posts = array();
        foreach ($favorites as $favorite) {
            $posts[] = Post::find($favorite->post_id);
        }

        return view('favorites.index')->with('posts', $posts);
    }

    public function verify(Request $request) {
        $user_id = $_COOKIE['user_id'];
        $result = Favorite::where('user_id', '=', $user_id)
            ->where('post_id', '=', $request->post_id)
            ->first();
        var_dump($request->post_id);
        if ($result == null) {
            $favorite = new Favorite;
            $favorite->user_id = $_COOKIE['user_id'];
            $favorite->post_id = $request->post_id;
            $favorite->save();
        }
        else {
            $result->delete();
        }
        return redirect('posts');
    }
}
