@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Scores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            @can('crear-score')
                            <a class="btn btn-warning" href="{{route('scores.create')}}">New</a>
                            @endcan

                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="color:#fff;">Name</th>
                                    <th style="color:#fff;">Academic Year</th>
                                    <th style="color:#fff;">Course</th>
                                    <th style="color:#fff;">Subject</th>
                                    <th style="color:#fff;">Trimester</th>
                                    <th style="color:#fff;">Mark 1</th>
                                    <th style="color:#fff;">Mark 2</th>
                                    <th style="color:#fff;">Mark 3</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($scores as $score)
                                    <tr>
                                        <td >{{$score->name}}</td>
                                        <td>{{$score->academicYear}}</td>
                                        <td>{{$score->course}}</td>
                                        <td>{{$score->subject}}</td>
                                        <td>{{$score->quarter}}</td>
                                        <td>{{$score->mark1}}</td>
                                        <td>{{$score->mark2}}</td>
                                        <td>{{$score->mark3}}</td>
                                        <td>
                                        <form action="{{ route('scores.destroy', $score->id)}}" method="POST">
                                            @can('edit-score')
                            <a class="btn btn-info" href="{{route('scores.edit', $score->id)}}">Edit</a>
                            @endcan

                            @csrf
                            @method('DELETE')
                            @can('delete-score')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                                        </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $scores->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection