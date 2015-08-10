@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Category</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Display categories list.
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Loai</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td><a href="{{url('admin/posts/?cat='. $cat->id)}}">{{$cat->name}}</a></td>
                                <td>{{ ($cat->parent_id) ? 'Con' : 'Cha'}}</td>
                                <td>
                                    <button id-attr="{{$cat->id}}" class="btn btn-primary btn-sm edit-category" type="button">Edit</button>&nbsp;
                                    <button class="btn btn-primary btn-sm" type="button">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary add-category" type="button">Add</button>
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
            $('.add-category').click(function(){
                window.location.href = window.baseUrl + '/admin/categories/create';
            });
            $('.edit-category').click(function(){
                window.location.href = window.baseUrl + '/admin/categories/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection