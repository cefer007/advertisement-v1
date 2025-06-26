@extends('dashboard.template.main')


@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Car</h1>
            <div>
                <a href="{{route('dashboard.car.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i
                        class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
            </div>
        </div>

        <form action="{{route('dashboard.car.update', $car->id) }}" method="Post">
            @csrf

            <div class = "form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $car->name }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-sm btn-success btn-block">Update</button>
        </form>
    </div>

@endsection
