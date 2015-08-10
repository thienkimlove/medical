@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bài viết</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            @if (!empty($post))
            <h2>Sửa bài "{{ $post->title }}"</h2>
            {!! Form::model($post, ['method' => 'PATCH', 'route' => ['admin.posts.update', $post->id], 'files' => true]) !!}
            @else
                <h2>Thêm bài mới</h2>
                {!! Form::model($post = new App\Post, ['route' => ['admin.posts.store'], 'files' => true]) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', 'Tiêu đề') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Chọn thư mục cho bài') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Ảnh đại diện cho bài viết') !!}
                @if ($post->image)
                    <img src="{{url('image-cached/120x120/' . $post->image)}}" />
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::label('desc', 'Mô tả ngắn') !!}
                {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('city', 'City (dùng cho Phân phối)') !!}
                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                </div>

            <div class="form-group">
                {!! Form::label('content', 'Nội dung chính') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control ckeditor']) !!}
            </div>

              @foreach ($modules as $key => $module)
                    <div class="form-group">

                        {!! Form::label('modules['.$key.']', $module) !!}

                        {!! Form::checkbox('modules['.$key.'][display]', null, $post->modules->contains('slug', $key)) !!}

                        {!! Form::text('modules['.$key.'][order]', ($post->modules->where('slug', $key)->first()) ? $post->modules->where('slug', $key)->first()->order : 0) !!}

                    </div>
                @endforeach

            <div class="form-group">
                {!! Form::label('tag_list', 'Từ khóa') !!}
                {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('status', 'Xuất bản') !!}
                {!! Form::checkbox('status', null, null) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}

            @include('errors.list')

        </div>
    </div>
@stop

@section('footer')
    <script>
        $('#tag_list').select2({
            placeholder : 'Chọn hoặc tạo từ khóa mới',
            tags : true //allow to add new tag which not in list.
        });
    </script>
@endsection
