@extends('admin')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$contact->name}}
            </div>
            <div class="panel-body">
                <p>{{$contact->email}}</p>
                <p>{{$contact->phone}}</p>
                <p>{{$contact->content}}</p>
            </div>
        </div>

    </div>
@endsection