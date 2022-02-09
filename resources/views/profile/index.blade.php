@extends('layouts.app')

@section('content')
<div class="container px-5">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$user->avatar}}" class="rounded-circle w-100">
        </div>
        <div class="col-7 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3" >
                    <h1 class="mr-3">{{$user->name}}</h1>
                    @cannot('update', $user->profile)
                    <input type="button" onclick="follow(this)" id="{{$user->id}}" class="{{($follow) ? 'btn btn-secondary  ml-3' : 'btn btn-primary ml-3'}}" value="{{($follow) ? 'Following' : 'Follow'}}">
                    @endcan
                </div>
            @can('update', $user->profile)
                <a href="/p/create">Add New Post</a>
            @endcan

            </div>

            @can('update', $user->profile)
            <a href="/p/{{$user->id}}/edit">Edit Profile</a>
            @endcan

            <div class="d-flex">
                <div style="padding-right:50px"><strong>{{$posts}}</strong> posts</div>
                <div style="padding-right:50px"><strong>{{$followers}}</strong> followers</div>
                <div style="padding-right:50px"><strong>{{$following}}</strong> following</div>
            </div>
            <div class="pt-4"><strong>{{$user->profile->title}}</strong></div>
            <div>{{$user->profile->description}}</div>
            <div><a href="">{{$user->profile->url}} </a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{$post->id}}">
                    <img class="w-100" src="/storage/{{$post->images}}" alt="">
                </a>
            </div>
        @endforeach
    </div>
</div>

<script>
    function follow(button){
        var id = button.id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'/follow/'+id,
            success:function(response) {
                console.log(response.attached);
                const element = document.getElementById(id);
                if(response.attached>0){
                    element.className = "btn btn-secondary";
                    element.value = 'Following'
                }
                else{
                    element.className = "btn btn-primary";
                    element.value = 'Follow'
                }

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                if(errorThrown == 'Unauthorized'){
                    location.href = "/login";
                }
            } 
        });
    }
</script>
@endsection
