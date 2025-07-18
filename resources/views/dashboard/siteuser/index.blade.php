@extends('dashboard.template.main')


@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Site Users</h1>
            <div>

            </div>
        </div>
    </div>

    <form action="">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ request()->get('name') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Creator</label>
                    <input type="text" name="creator" value="{{ request()->get('creator') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div style="visibility : hidden ">Button</div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search">

                    </i>
                </button>

                <a href="http://127.0.0.1:8000/dashboard/car/index?name=&creator=" class="btn btn-primary">
                    <i class="fa fa-sync-alt"></i> Refresh
                </a>

            </div>
        </div>
    </form>

    <html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ ($loop->index + 1) + (10 * ((request()->get('page')) ?? 1 - 1)) }}</td>
{{--                    page hardan gorur--}}
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                       #
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}


@endsection
