@extends('layouts.app')
@section('menu')
<li class="nav-item">
    <a id="navbarDropdown" class="nav-link"  href="{{route('home')}}" role="button" >
        <strong>Blog Home</strong>
    </a>
</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between"><div> <strong>{{ __('Edit Blog Category') }}</strong></div> <div>

                    <a id="navbarDropdown" class="mx-2"  href="{{route('category.report')}}" role="button" > <button type="button" class="btn btn-danger">
                        BACK
                </button>
            </a>
                    </div> </div>

                <div class="card-body">
                    <form action="{{route('category.update')}}" method="POST"  >
                        @csrf
                        <input  type="hidden" name="id" value="{{$cat->id}}" />
                        <div class="form-group">
                          <label for="category">Category</label>
                          <input required type="text" class="form-control" value="{{$cat->category_name}}" name="category_name" aria-describedby="Category" placeholder="Enter Category Name">
                          {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        {{-- <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">update</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
