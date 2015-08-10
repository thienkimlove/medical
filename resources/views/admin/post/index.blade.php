@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bài viết</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="input-group custom-search-form">
                        {!! Form::open(['method' => 'GET', 'route' =>  ['admin.posts.index'] ]) !!}
                        <input type="text" value="{{$searchPost}}" name="q" class="form-control" placeholder="Search post..">
                        <input type="hidden" name="cat" value="{{$categoryId}}" />
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu </th>
                                <th>Mô tả</th>
                                <th>Ảnh đại diện</th>
                                <th>Chuyen muc</th>
                                <th>Xuất bản</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->desc}}</td>
                                    <td><img src="{{url('image-cached/120x120/' . $post->image)}}" /></td>
                                    <td>{{$post->category->name}}</td>
                                    <td>{{($post->status) ? 'Yes' : 'No'}}</td>
                                    <td>
                                        <button id-attr="{{$post->id}}" class="btn btn-primary btn-sm edit-post" type="button">Sua</button>&nbsp;
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.posts.destroy', $post->id]]) !!}
                                        <button type="submit" class="btn btn-danger btn-mini">Xoa</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="row">

                        <div class="col-sm-6">{!!$posts->render()!!}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-primary add-post" type="button">Add</button>
                        </div>
                    </div>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    </div>
@endsection
@section('footer')
    <script>
        $(function(){
            $('.add-post').click(function(){
                window.location.href = window.baseUrl + '/admin/posts/create';
            });
            $('.edit-post').click(function(){
                window.location.href = window.baseUrl + '/admin/posts/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection