@extends('layouts.app')

@section('content')
<div class="container px-5">
    <form action="/p" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h3>Add New Post</h3>
                </div>
                <div class="row">
                    <label for="title" class="col-md-4 col-form-label">Captiotitlen</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" 
                        value="{{ old('title') }}"  autocomplete="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Image</label>
                    <input type="file" class="form-control-file" id="image" name="images">
                    @error('images')
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
