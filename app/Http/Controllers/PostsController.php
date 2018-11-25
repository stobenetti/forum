<?php

namespace App\Http\Controllers;

use App\Favorite;
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

        $favorites = Favorite::select('post_id')->whereUser_id($_COOKIE['user_id'])->get();
        $favorites = $favorites->toArray();

        $favs = array();
        foreach ($favorites as $favorite) {
            $favs[] = $favorite['post_id'];
        }

        return view('posts.index')
            ->with('posts', $posts)
            ->with('favorites', $favs);
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
        $this->validate($request,
            [
                'title' => 'required|max:255',
                'content' => 'required|max: 255'
            ],
            [
                'title.required' => 'O campo Título deve ser preenchido.',
                'content.required' => 'O campo Conteúdo deve ser preenchido.',
                'title.max' => 'O limite de caracteres para o campo Título é de 255.',
                'content.max' => 'O limite de caracteres para o campo Conteúdo é de 255.'
            ]
        );

        $post = new Post;
        $post->user_id = $_COOKIE['user_id'];
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();

        return redirect('posts/' . $post->id);
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
        if ($_COOKIE['user_id'] == $post->user_id) {
            return view('posts.edit')->with('post', $post);
        }
        return redirect('posts/' . $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request,
            [
                'title' => 'required|max:255',
                'content' => 'required|max: 255'
            ],
            [
                'title.required' => 'O campo Título deve ser preenchido.',
                'content.required' => 'O campo Conteúdo deve ser preenchido.',
                'title.max' => 'O limite de caracteres para o campo Título é de 255.',
                'content.max' => 'O limite de caracteres para o campo Conteúdo é de 255.'
            ]
        );

        $post = Post::find($id);
        if ($_COOKIE['user_id'] == $post->user_id) {
            $post->update($request->all());
        }
        return redirect('posts/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $post = Post::find($id);
        if ($_COOKIE['user_id'] == $post->user_id) {
            $post->deleted = 1;
            $post->save();
        }
        return redirect('posts');
    }

}
