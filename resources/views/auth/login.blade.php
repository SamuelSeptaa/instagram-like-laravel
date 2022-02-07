@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col-md-8 offset-md-4">
                            <a href="{{route('google-login')}}" class="btn btn-danger">Sign in with Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
