@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit To Do List</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5>{{$todo->id }} :: {{ $todo->title }}</h5>
                    <a href="{{ route('todo.index') }}" class="btn btn-sm btn-success float-end">Back to To Do List</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('todo.update',$todo->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <input type="hidden" id="id" name="id" value="{{$todo->id}}">
                        <div class="form-group mb-3">
                            <label for="user_id">User ID</label>
                            <input type="number" value="{{$todo->user_id}}" id="user_id" class="form-control" name="user_id"
                                   required autofocus>
                            @if ($errors->has('user_id'))
                                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" value="{{$todo->title}}" id="title" class="form-control"
                                   name="title" required autofocus>
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="completed">Completed</label>
                            <select class="form-select" aria-label="Default select example" id="completed" name="completed" required>

                                @foreach($bools as $key => $value)
                                    <option {{ $key  == $todo->completed ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="d-grid ">
                            <button type="submit" class="btn-sm btn-outline-success">Update</button>
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
@endsection



