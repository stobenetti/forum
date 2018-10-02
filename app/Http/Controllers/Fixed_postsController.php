<?php

namespace App\Http\Controllers;

use App\Fixed_post;
use Illuminate\Http\Request;

class Fixed_postsController extends Controller {

    public function verify($post_id) {
        $user_id = Auth::id();
        $result = Fixed_post::where(['user_id' => $user_id, 'post_id' => $post_id])->first();
        if ($result = null) {
            $fixed_post = new Fixed_post;
            $fixed_post->user_id = $user_id;
            $fixed_post->post_id = $post_id;
            $fixed_post->save();
        }
        else {
            $result->delete();
        }
        return redirect('posts');
    }
}
