@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Video</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            @if (!empty($video))
                <h2>Sửa Video "{{ $video->title }}"</h2>
                {!! Form::model($video, ['method' => 'PATCH', 'route' => ['admin.videos.update', $video->id], 'files' => true]) !!}
            @else
                <h2>Thêm Video</h2>
                {!! Form::model($video = new App\Video, ['route' => ['admin.videos.store'], 'files' => true]) !!}
            @endif

            <div class="form-group">
                {!! Form::label('image', 'Ảnh đại diện cho Video') !!}
                @if ($video->image)
                    <img src="{{url('image-cached/120x120/' . $video->image)}}"/>
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('title', 'Tiêu đề Video') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                    {!! Form::label('file_name', 'Video URL') !!}
                    {!! Form::text('file_name', null, ['class' => 'form-control']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('desc', 'Mo ta Video') !!}
                    {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('product_id', 'Chọn san pham') !!}
                    {!! Form::select('product_id', $products, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('hot', 'Hot Video') !!}
                    {!! Form::checkbox('hot', null, null) !!}
                </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop