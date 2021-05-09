@extends('layouts.app')
@section('title', 'detail page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <div class="card">
                <div class="card-header">
                   {{ $post->id }}
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->body }}</p>
                    <div class="card-footer bg-transparent"><span class="font-weight-bold">by:</span> {{ $post->user->name }}</div>
                    @if($post->user_id == auth()->user()->id)
                        <a href="{{ route('post.edit', $post) }}" class="btn btn-dark">編集する</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection