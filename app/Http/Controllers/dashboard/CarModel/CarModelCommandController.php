<?php

namespace App\Http\Controllers\dashboard\carModel;

use App\Http\Controllers\Controller;
use App\Http\Requests\carModel\CarModelStoreRequest;
use App\Models\Car;
use App\Http\Requests\Dashboard\Car\CarUpdateRequest;
use App\Models\CarModel;
use App\Util\messageUtil\messageUtil;

class CarModelCommandController extends Controller
{
    public function store(CarModelStoreRequest $request)
    {
        $carModelCheck = CarModel::query()
            ->where('car_id', $request->car_id)
            ->where('name',$request->name)
            ->exists();

        if($carModelCheck){
            return to_route('dashboard.car-model.create')->with('error', messageUtil::Duplicate);
        }

        CarModel::query()->create([
            'name' => $request->name,
            'created_by' => auth()->user()->id,
            'car_id' => $request->car_id
        ]);

    return to_route('dashboard.car-model.create')->with('success', messageUtil::Created);
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
