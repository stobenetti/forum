<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class RepliesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id) {
        $post = Post::find($post_id);
        return view('replies.create')->with(['post_id' => $post_id, 'post' => $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $reply = new Reply;
        $reply->post_id = $request->get('post_id');
        $reply->user_id = $_COOKIE['user_id'];
        $reply->user_name = $_COOKIE['user_name'];
        $reply->content = $request->get('content');
        $reply->save();

        return redirect('posts/' . $reply->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $reply = Reply::find($id);
        if ($_COOKIE['user_id'] != $reply->user_id) {
            return redirect('posts/' . $reply->post_id);
        }
        return view('replies.edit')
            ->with('reply', $reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $reply = Reply::find($id);
        if ($_COOKIE['user_id'] == $reply->user_id) {
            $reply->update($request->all());
        }
        return redirect('posts/' . $reply->post_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $reply = Reply::find($id);
        if ($_COOKIE['user_id'] == $reply->user_id) {
            $reply->deleted = 1;
            $reply->save();
        }
        return redirect('posts/' . $reply->post_id);
    }

}
