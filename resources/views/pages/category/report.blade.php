@extends('layouts.app')
@section('menu')
    <li class="nav-item">
        <a id="navbarDropdown" class="nav-link" href="{{ route('home') }}" role="button">
         <strong>Blog Home</strong>
        </a>
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div><strong> {{ __(' Blog Category') }}</strong></div>

                        <div class="d-flex justify-content-between">
                            <a id="navbarDropdown" href="{{ route('category.create') }}" role="button" class="mx-2">
                                <button type="button" class="btn btn btn-success">

                                    Create

                                </button>
                            </a>
                            <a id="navbarDropdown" class="mx-2" href="{{ route('blog.report') }}" role="button"> <button
                                    type="button" class="btn btn-danger">

                                    Blog

                                </button>
                            </a>
                        </div>



                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered category_datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('.category_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.report') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'category_name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
