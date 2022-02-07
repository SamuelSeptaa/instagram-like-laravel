@extends('layouts.app')

@section('content')
<div class="container px-5">
    <form action="/profile/{{$id->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h3>Edit Post</h3>
                </div>
                <div class="row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" 
                        value="{{ $id->profile->title }}"  autocomplete="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row">
                    <label for="description" class="col-md-4 col-form-label">description</label>
                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" 
                        value="{{ $id->profile->description }}"  autocomplete="description" autofocus>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="row">
                    <label for="url" class="col-md-4 col-form-label">url</label>
                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" 
                        value="{{ $id->profile->url }}"  autocomplete="url" autofocus>
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row">
                    <label for="avatar" class="col-md-4 col-form-label">avatar</label>
                    <input type="file" class="form-control-file" id="avatar" name="avatar">
                    @error('avatar')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="pt-5">
                    <input type="submit" class="btn btn-primary" value="Add" name="submit">
                </div>
            </div>
        </div>
    </form>
    
</div>
@endsection
