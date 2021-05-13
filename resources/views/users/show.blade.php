@php
    $title = __('User') . ': ' . $user->name;
@endphp
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    <div>
        @if($user->id == auth()->user()->id)
        <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">
            {{ __('Edit') }}
        </a>
        @endif
    </div>
    <dl class="row">
        <dt class="col-md-2">{{ __('ID') }}</dt>
        <dd class="col-md-10">{{ $user->id }}</dd>
        <dt class="col-md-2">{{ __('Name') }}</dt>
        <dd class="col-md-10">{{ $user->name }}</dd>
        <dt class="col-md-2">{{ __('E-Mail Address') }}</dt>
        <dd class="col-md-10">{{ $user->email }}</dd>
    </dl>
</div>
@endsection
