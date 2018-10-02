<?php

namespace App\Http\Controllers;

use App\Post;
use App\Reply;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::whereDeleted(0)->get();
        return view('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::find($id);
        $replies = Reply::where(['post_id' => $id, 'deleted' => 0])->get();
        return view('posts.show')
            ->with('post', $post)
            ->with('replies', $replies);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = Post::find($id);
        if (Auth::id() == $post->user_id) {
            return view('posts.edit')->with('post', $post);
        }
        return redirect('posts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $post = Post::find($id);
        if (Auth::id() == $post->user_id) {
            $post->update($request->all());
        }
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $post = Post::find($id);
        if (Auth::id() == $post->user_id) {
            $post->deleted = 1;
            $post->save();
        }
        return redirect('posts');
    }

}
