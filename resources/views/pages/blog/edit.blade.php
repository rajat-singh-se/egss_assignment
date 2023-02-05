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
                <div class="card-header d-flex justify-content-between"><div> <strong>{{ __('Update Blog ') }}</strong></div> <div>

                    <a id="navbarDropdown" class="mx-2"  href="{{route('blog.report')}}" role="button" > <button type="button" class="btn btn-danger">

                        BACK

                </button>
            </a></div> </div>

                <div class="card-body">
                    <form action="{{route('blog.update')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input  type="hidden" name="id" value="{{$blog->id}}" />

                        <div class="form-group  my-3">
                          <label for="Title">Title</label>
                          <input required type="text" class="form-control" value="{{$blog->title}}" name="title" aria-describedby="title" placeholder="Enter title">
                          {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>

                        <div class="form-group  my-3">
                            <label for="Description">Description</label>
                            <textarea required class="form-control"  id="description" name="description" rows="3">{{$blog->description}}</textarea>
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                          </div>
                          <div class="form-group  my-3">
                            <label for="Description">Category</label>
                            <select required class="form-control" name="category_id" value="{{$blog->category_id}}" >
                                <option value="">Select Category</option>
                                @foreach ($cat as $item)
                                <option @if ($blog->category_id==$item->id)
                                    selected
                                @endif value="{{$item->id}}">{{$item->category_name}}</option>

                                @endforeach

                            </select>
                            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                          </div>
                          <div class="form-group my-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                          </div>
                        {{-- <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div> --}}
                        <div class="form-check  my-3"  >
                          <input type="checkbox" name="status" @if ($blog->status==1)
                          checked

                          @endif   class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label"  for="status">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
