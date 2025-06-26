<?php

namespace App\Http\Controllers\dashboard\car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Car\CarStoreRequest;
use App\Models\Car;
use App\Http\Requests\Dashboard\Car\CarUpdateRequest;

class CarCommandController extends Controller
{
    public function store(CarStoreRequest $request)
    {
        Car::query()->create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
        ]);

    return to_route('dashboard.car.index')->with('success', 'Successfully Created');
    }

    public function update($id , CarUpdateRequest $request)
    {
        Car::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
            ]);

        return to_route('dashboard.car.edit', $id)->with('success', 'Successfully Updated');
    }
}
