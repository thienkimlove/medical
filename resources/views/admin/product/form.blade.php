@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            @if (!empty($product))
                <h2>Sửa Sản phẩm "{{ $product->title }}"</h2>
                {!! Form::model($product, ['method' => 'PATCH', 'route' => ['admin.products.update', $product->id], 'files' => true]) !!}
            @else
                <h2>Thêm Sản phẩm</h2>
                {!! Form::model($product = new App\Product, ['route' => ['admin.products.store'], 'files' => true]) !!}
            @endif

            <div class="form-group">
                {!! Form::label('image', 'Ảnh đại diện cho Sản phẩm') !!}
                @if ($product->image)
                    <img src="{{url('image-cached/120x120/' . $product->image)}}"/>
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('title', 'Tiêu đề sản phẩm ') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('thongtin', 'Thông tin sản phẩm ') !!}
                {!! Form::textarea('thongtin', null, ['class' => 'form-control ckeditor']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nghiencuu', 'Nghiên cứu sản phẩm ') !!}
                {!! Form::textarea('nghiencuu', null, ['class' => 'form-control ckeditor']) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop