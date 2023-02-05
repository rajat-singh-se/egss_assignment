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
                <div class="card-header d-flex justify-content-between"><div><strong> {{ __('Create Blog ') }}</strong></div> <div>

                    <a id="navbarDropdown" class="mx-2"  href="{{route('blog.report')}}" role="button" > <button type="button" class="btn btn-danger">

                        BACK

                </button>
            </a></div> </div>

                <div class="card-body">
                    <form action="{{route('blog.save')}}" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group  my-3">
                          <label for="Title">Title</label>
                          <input required type="text" class="form-control" name="title" aria-describedby="title" placeholder="Enter title">
                          {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>

                        <div class="form-group  my-3">
                            <label for="Description">Description</label>
                            <textarea required class="form-control" id="description" name="description" rows="3"></textarea>
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                          </div>
                          <div class="form-group  my-3">
                            <label for="Description">Category</label>
                            <select required class="form-control" name="category_id" >
                                <option value="">Select Category</option>
                                @foreach ($cat as $item)
                                <option value="{{$item->id}}">{{$item->category_name}}</option>

                                @endforeach

                            </select>
                          </div>
                          <div class="form-group my-3">
                            <label for="image">Image</label>
                            <input required type="file" class="form-control-file" name="image" id="image">
                          </div>

                        <div class="form-check  my-3">
                          <input type="checkbox" checked name="status"  class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label"  for="status">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
