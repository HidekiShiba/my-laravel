<?php

namespace App\Http\Controllers;

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
        $posts = Post::all(); // paginate を使ってみる。
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
    public function store(Request $request)
    {
        $id = Auth::id();
        //インスタンス作成
        $post = new Post();
        $post->body = $request->body;
        $post->user_id = $id;

        $post->save();

       return redirect()->to('/posts'); // redirect()->route('post.index') へ変更
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // 新しく追加した relations メソッドで
        // $user = $post->user; でユーザーを取得出来る。
        $user_id = $post->user_id;
        $user = DB::table('users')->where('id', $user_id)->first();

        return view('posts.detail',['post' => $post, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // $id　ではなく、Post $post へ変更。
    {
        // $usr_id = $post->user_id;
        $post = \App\Post::findOrFail($id); //削除する

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
    public function update(Request $request)
    {
        // edit　メソッドと同じく Post $post で自動的に取得する。
        $id = $request->post_id;
        //レコードを検索
        $post = Post::findOrFail($id);
        $post->body = $request->body;
        //保存（更新）
        $post->save();
        return redirect()->to('/posts');
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
}
