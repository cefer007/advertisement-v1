<?php

namespace App\Http\Controllers\dashboard\car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Car\CarStoreRequest;
use App\Models\Car;
use App\Http\Requests\Dashboard\Car\CarUpdateRequest;
use App\Util\messageUtil\messageUtil;

class CarCommandController extends Controller
{
    public function store(CarStoreRequest $request)
    {
        Car::query()->create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
        ]);

    return to_route('dashboard.car.index')->with('success', messageUtil::Created);
    }

    public function update($id , CarUpdateRequest $request)
    {
        Car::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
            ]);

        return to_route('dashboard.car.edit', $id)->with('success', messageUtil::Updated);
    }

    public function delete($id)
    {
        Car::query()
            ->where('id', $id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s'),
                'deleted_by' => auth()->user()->id
            ]);

        return to_route('dashboard.car.index')->with('success', messageUtil::Deleted);
    }

    public function restore($id)
    {
        Car::query()
            ->where('id', $id)
            ->update([
                'deleted_at' => null,
                'deleted_by' => null
            ]);

        return to_route('dashboard.car.trash')->with('success', messageUtil::Restored);
    }
}
