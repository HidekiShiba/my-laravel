@extends('layouts.app')
@section('title', 'TOP page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-8 offset-1 offset-md-2">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th colspan="3">内容</th>
                    </tr>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->body }}</td>
                        <td>
                            {{-- <a href="{{ url('posts/'.$post->id) }}" class="btn btn-success">詳細</a> --}}
                            {{-- <a href="{{ route('post.edit', $post) }}" method="POST"> --}}
                            <a href="{{ route('post.show', $post) }}" class="btn btn-success">詳細</a>
                        @if($post->user_id == auth()->user()->id)
                            <form action="{{ route('post.destroy', $post) }}" method="DELETE">
                                @csrf
                                <input type="submit" value="削除" class="btn btn-danger post_del_btn">
                            </form>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection