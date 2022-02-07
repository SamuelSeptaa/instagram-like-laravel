@extends('layouts.app')

@section('content')
<div class="container px-5">
    @if($posts->count()<1)
    <div class="row">
        <div class="col-12 align-items-center">
            <h3> No Post(s) yet</h3>
        </div>
    </div>
    @endif
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/profile/{{$post->user->id}}"><img src="/storage/{{$post->images}}" alt="" class="w-100"></a>
        </div>
        <div class="row">
            <div class="col-6 offset-3 pt-2 pb-4">
                <div><span><strong>{{$post->user->name}}</strong></span> {{$post->title}}</div>
            </div>
        </div>
        
    </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection