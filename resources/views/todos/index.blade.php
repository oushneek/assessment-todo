@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">To Do Lists</h1>
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
                    <a href="{{ route('todo.export') }}" class="btn btn-sm btn-success ">Export</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Id</th>
                            <th>UserID</th>
                            <th>Title</th>
                            <th>Completed</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($todos as $todo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $todo->id}}</td>
                                <td>{{ $todo->user_id }}</td>
                                <td>{{ $todo->title }}</td>
                                <td>{{ $todo->completed }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm " href="{{ route('todo.edit', $todo->id) }}">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('todo.delete',$todo->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-danger btn-sm delete-todo" value="Delete">
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $todos->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>


    <!-- /.content -->
@endsection

@section('styles')

@endsection


@section('scripts')

    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></script>


<script>
        $(document).ready(function () {

            $('#example').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
</script>
@endsection
