<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $user = $this->guard()->user();
        $post = Post::create([
            'body' => $request->body,
            'user_id' => $user->id,
        ]);
        // $id = Auth::id();
        // //インスタンス作成
        // $post = new Post();
        // $post->body = $request->body;
        // $post->user_id = $id;

        // $post->save();

       return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // relationsで修正
        $user = $post->user;
        // $user_id = $post->user_id;
        // $user = DB::table('users')->where('id', $user_id)->first();

        return view('posts.detail',['post' => $post, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $usr_id = $post->user_id;
        // $post = \App\Post::findOrFail($id);

        return view('posts.edit',['post' => $post]);
        // return view('posts.edit');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) // Post $post の引用追加されていなかった。
    {
        $post->body = $request->body;
        //保存（更新）
        $post->save();
        return redirect()->route('post.index'); // to()　を避けて route() でリダイレクト先を定義する。
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = \App\Post::find($id);
        //削除
        $post->delete();

        return redirect()->to('/posts');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
