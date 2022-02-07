@extends('layouts.app')

@section('content')
<div class="container px-5">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{$post->images}}" alt="" class="w-100">
        </div>

        <div class="col-4">
            <div class="d-flex align-items-center">
                <div>
                    <img src="{{$post->user->avatar}}" class="w-100 rounded-circle" style="max-width:30px" alt="">
                </div>
                <div  class="px-3">
                    <div class="font-weight-bold">
                        <a href="/profile/{{$post->user->id}}"><strong class="text-dark">{{$post->user->name}}</strong></a>
                        <a href="#" class="px-3">Follow</a>
                    </div>
                </div>
            </div>

            <hr>
            <p><span><strong>{{$post->user->name}}</strong></span> {{$post->title}}</p>
        </div>
    </div>
</div>
@endsection