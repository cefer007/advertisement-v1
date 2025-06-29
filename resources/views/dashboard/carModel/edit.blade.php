@extends('dashboard.template.main')


@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Car Model</h1>
            <div>
                <a href="{{route('dashboard.car-model.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i>Back</a>
            </div>
        </div>

        <form action="{{route('dashboard.car-model.update',$model->id)}}" method="Post">
            @csrf
            @method('POST')
            <div class = "form-group">
                <label for="">Name</label>
                <input type="text" value="{{ $model->name }}" name="name" class="form-control">
            </div>

            <div class = "form-group">
                <select class="form-control" name="car_id" id="">
                    @foreach($cars as $car)
                    <option @if($car->id == $model->car_id) selected @endif value="{{ $car->id }}">{{ $car->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-sm btn-success btn-block">Update</button>
        </form>
    </div>

@endsection
