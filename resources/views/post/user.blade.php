@extends('layouts.app')

@section('content')
<div class="container px-5">
    @if($list->count()<1) 
    <div class="d-flex align-items-baseline">
        <div class="col-8 pb-4">
            No User Found
        </div>
    </div>
    @endif
    @foreach($list as $lists)
    <div class="d-flex align-items-baseline">
        <div class="col-8 pb-4">
            <a href="/profile/{{$lists->id}}"><h2 class="text-dark">{{$lists->name}}</h2></a>
            @if(auth()->user()->following->contains($lists->id))
            <span>Following</span>
            @endif
        </div>
    </div>
    @endforeach

</div>
@endsection