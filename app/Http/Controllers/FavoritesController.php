<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Favorite;

class FavoritesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_id = Auth::id();
        $favorites = Favorite::where('user_id', $user_id)
            ->get();
        return view('favorites.index')->with('favorites', $favorites);
    }

    public function verify(Request $request) {
        $user_id = Auth::id();
        $result = Favorite::where('user_id', '=', $user_id)
            ->where('post_id', '=', $request->post_id)
            ->first();
        var_dump($result);
        if ($result == null) {
            $favorite = new Favorite;
            $favorite->user_id = Auth::id();
            $favorite->post_id = $request->post_id;
            $favorite->save();
        }
        else {
            $result->delete();
        }
        return redirect('posts');
    }
}
