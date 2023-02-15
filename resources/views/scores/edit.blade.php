@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Create Score</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <strong>check the fields!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{$error}}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                        </div>
                            @endif

                            <form action="{{ route('scores.update', $score->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                            <div class="row">
                                <input type="hidden" name="id" class="form-control" value="{{ $score->id }}">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="academicYear">Academic Year</label>
                                        <input type="text" name="academicYear" class="form-control" value="{{ $score->academicYear }}">
                                    </div>
                                </div>
                            </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="course">Course</label>
                                        <input type="text" name="course" class="form-control"  value="{{ $score->course }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" class="form-control" value="{{ $score->subject }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="quarter">Trimester</label>
                                <input type="text" name="quarter" class="form-control" value="{{ $score->quarter }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="mark1">Mark 1</label>
                            <input type="text" name="mark1" class="form-control" value="{{ $score->mark1 }}">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="mark2">Mark 2</label>
                        <input type="text" name="mark2" class="form-control" value="{{ $score->mark2 }}">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="mark3">Mark 3</label>
                    <input type="text" name="mark3" class="form-control" value="{{ $score->mark3 }}">
                </div>
            </div>
                            
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
