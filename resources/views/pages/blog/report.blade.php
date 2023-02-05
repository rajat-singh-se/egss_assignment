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
                <div class="card-header d-flex justify-content-between"><div><strong> {{ __(' Blog Report') }}</strong></div>
                <div class="d-flex justify-content-between">
                    <a id="navbarDropdown"  href="{{route('blog.create')}}" role="button" class="mx-2" > <button type="button" class="btn btn btn-success">

                        Create

                </button>
            </a>
            <a id="navbarDropdown" class="mx-2"  href="{{route('category.report')}}" role="button" > <button type="button" class="btn btn-primary">

                Category

        </button>
    </a>
                </div>
             </div>

             <div class="card-body">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered blog_datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Disciption</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Slug</th>
                                    <th>Status</th>
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
            var table = $('.blog_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('blog.report') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'tilte'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function( data, type, full, meta ) {
                        return data.slice(0, 50);
                    }
                    },
                    {
                        data: 'category.category_name',
                        name: 'category'
                    },
                    { data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        return `<img src="/${data}"  width="50"/>`;
                    }
                },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function( data, type, full, meta ) {
                        return data==1?'Active':'Deactive';
                    }
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
