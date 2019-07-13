@extends('app')

@section('content')
    <h1 class="panel-heading">Form</h1>

    <div class="panel-body" data-ng-controller="FormController">

        <form>
            <textarea data-ckeditor data-ng-model="data.text"></textarea>

        </form>

    </div>

@endsection