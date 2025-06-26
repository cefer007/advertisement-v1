<?php

namespace App\Http\Controllers\dashboard\car;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarQueryController extends Controller
{
    public function index()
    {
        $cars = Car::query()
            ->from('Cars as c')
            ->select('c.id',
            'c.name',
            'c.created_at',
            'u.name as creator')
            ->join('users as u', 'u.id' ,  'c.created_by')
            ->whereNull('c.deleted_at')
            ->orderBy('c.id', 'desc')
            ->paginate(10);

        return view('dashboard.car.index',compact('cars'));
    }

    public function create()
    {
        return view('dashboard.car.create');
    }

    public function edit($id)
    {
        $car = Car::query()
            ->from('Cars as c')
            ->where('c.id' , $id)
            ->first();

        if(!$car){
            abort('404');
        }
        return view('dashboard.car.edit',compact('car'));
    }
}
