@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Category</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
           @if (!empty($category))
                <h2>Edit "{{ $category->name }}"</h2>
                {!! Form::model($category, ['method' => 'PATCH', 'route' => ['admin.categories.update', $category->id]]) !!}
           @else
                <h2>Add New Category</h2>
                {!! Form::model(new App\Category, ['route' => ['admin.categories.store']]) !!}
           @endif
            <div class="form-group">
                {!! Form::label('Name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Parent', 'Parent') !!}
                {!! Form::select('parent_id', $parents, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop