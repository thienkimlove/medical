@extends('admin')
@section('content')
    @include('admin.contact.heading')
    <div class="row" data-ng-controller="ContactIndex">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Display contacts form users.
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{str_limit($contact->content, 50)}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-ng-click="goUrl('/contacts/{{$contact->id}}')" type="button">Show</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">{!! $contacts->render() !!}</div>
                    </div>

                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    </div>
@endsection