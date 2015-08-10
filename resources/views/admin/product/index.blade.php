@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Danh sách Sản phẩm
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu đề </th>
                                <th>Image</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}</td>
                                    <td><img src="{{url('image-cached/110x70', $product->image)}}" /></td>
                                    <td>
                                        <button id-attr="{{$product->id}}" class="btn btn-primary btn-sm edit-product"  type="button">Sửa</button>
                                        <br>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.products.destroy', $product->id]]) !!}
                                        <button type="submit" class="btn btn-danger btn-mini"> Xoa </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-sm-6"><button class="btn btn-primary add-product" type="button"> Thêm </button></div>
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
            $('.add-product').click(function(){
                window.location.href = window.baseUrl + '/admin/products/create';
            });
            $('.edit-product').click(function(){
                window.location.href = window.baseUrl + '/admin/products/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection