@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="background-color: #71D0F5;">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body table-Responsive" style="background-color: #FCE17A;">
                            
                            @can('create-rol')
                            <a class="btn btn-warning" href="{{route('roles.create')}}">New</a>
                            @endcan

                            <table class="table table-striped mt-2">
                                <thead style="background-color: #71D0F5;">
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @can('edit-rol')
                                            <a class="btn btn-warning" href="{{route('roles.edit', $role->id)}}">Edit</a>
                                            @endcan

                                            @can('delete-rol')
                                            {!! Form::open(['method'=> 'DELETE', 'route'=>['roles.destroy', $role->id], 'style'=>'display:inline']) !!}
                                                {!! Form::submit('delete', ['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection