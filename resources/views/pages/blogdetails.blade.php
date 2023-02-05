@extends('layouts.app')
@section('menu')
<li class="nav-item">
    <a id="navbarDropdown" class="nav-link"  href="{{route('home')}}" role="button" >
        <strong> Blog Setup</strong>
    </a>
</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between"><div><strong> {{ __('Blog details ') }}</strong></div> <div>

                    <a id="navbarDropdown" class="mx-2"  href="{{route('blogs')}}" role="button" > <button type="button" class="btn btn-danger">
                        BACK
                </button>
            </a>
                    </div> </div>

                <div class="card-body">
                    <div class="container my-5">
                        <h1 class="text-center">{{$blog->title}}</h1>
                        <p class="text-muted text-center">Published on  <strong>{{$blog->created_at->format('M d, Y H:i A')}}</strong> </p>
                        <hr>
                        <img src="/{{$blog->image}}" class="img-fluid mb-3" alt="Blog post image">
                        <p>{{$blog->description}}</p>

                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
