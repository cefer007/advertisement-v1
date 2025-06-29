@extends('dashboard.template.main')


@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Car Model</h1>
            <div>
                <a href="{{ route('dashboard.car-model.trash') }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                    class="fas fa-trash fa-sm text-white-50"></i>Trash</a>
                <a href="{{ route('dashboard.car-model.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i>Create</a>
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
                    <label for=""> Car </label>
                        <select class="form-control" name="car_id" >
                            <option value="">------------</option>
                            @foreach($cars as $car)
                                <option @if($car->id == request()->get('car_id')) selected @endif value="{{ $car->id }}">{{ $car->name }}</option>
                            @endforeach
                        </select>
                </div>
            </div>

            <div class="col-md-3">
                <div style="visibility : hidden ">Button</div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search">

                    </i>
                </button>

                <a href="http://127.0.0.1:8000/dashboard/car-model/index" class="btn btn-primary">
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
                <th>Model</th>
                <th>Car</th>
                <th>Creator</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    <td>{{ ($loop->index + 1) + (10 * ((request()->get('page')) ?? 1 - 1)) }}</td>
{{--                    page hardan gorur--}}
                    <td>{{$model->name}}</td>
                    <td>{{$model->car}}</td>
                    <td>{{$model->creator}}</td>
                    <td>{{$model->created_at}}</td>
                    <td>
                        <a href="{{ route('dashboard.car-model.edit', $model->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('dashboard.car-model.delete', $model->id) }}" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $models->links() }}


@endsection
