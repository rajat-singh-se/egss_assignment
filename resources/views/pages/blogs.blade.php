@extends('layouts.app')
@section('menu')
<li class="nav-item">
    <a id="navbarDropdown" class="nav-link"  href="{{route('blog.report')}}" role="button" >
      <strong> Blog Setup</strong>
    </a>
</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
          <h4 class="text-center my-3">Categories</h4>
          <ul class="list-group">
            @if(count($cat)==0)
            <div class="mt-3">
                <h5>No Category found !</h5>
            <a href="{{route('category.create')}}"><strong>Create Category</strong> </a>
            </div>
            @else
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{route('blogs')}}">All </a>
                 </li>
            @endif

            @foreach ($cat as $item )
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{route('blogs',[$item->slug])}}">   {{$item->category_name}} </a>
                 </li>



            @endforeach



          </ul>
        </div>
        <div class="col-md-9">
          <div class="row">
            @if(count($blogs)==0&&count($cat)!=0)
            <div class="mt-3">
                <h5>No Blog found !</h5>
            <a href="{{route('blog.create')}}"><strong>Create Blog</strong> </a>
            </div>
            @else

            @foreach ($blogs as $item)
            <div class="col-md-4">
                <div class="card mb-3">
                  <img src="/{{$item->image}}" class="card-img-top" alt="Blog post image">
                  <div class="card-body">
                    <h5 class="card-title">{{$item->title}}</h5>
                    <p class="card-text">{{Str::limit($item->description, 50)}} </p>
                    <a href="{{route('blog.details',[$item->slug])}}" class="btn btn-primary">Read More</a>
                  </div>
                </div>
              </div>

            @endforeach
            @endif


          </div>
        </div>
    </div>



</div>
@endsection
