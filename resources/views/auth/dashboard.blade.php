<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@include('partials.header')

<body>

<div class="container">
    <h1>Welcome to Assessment 1</h1>

    <div class="card">
        <div class="card-body">

            <a href="{{ route('todo.create') }}" class="btn btn-sm btn-success ">Add To Do from API to Database</a>

        </div>
    </div>
</div>
@yield('content')
</body>
</html>
