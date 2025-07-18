<?php

namespace App\Http\Controllers\site\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Ban;
use App\Models\Car;
use App\Models\City;
use App\Models\Color;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\Gear;
use App\Models\CarSupplier;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function index()
    {
        if (!auth()->guard('main')->check())
            return redirect('login');

        $cars = Car::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->whereNULL('deleted_by')
            ->get();

        $suppliers = FuelType::query()
            ->select('id', 'name')
            ->get();

        $fuels = FuelType::query()
            ->select('id', 'name')
            ->get();

        $gears = Gear::query()
            ->select('id', 'name')
            ->get();

        $bans = Ban::query()
            ->select('id', 'name')
            ->get();

        $currencies = Currency::query()
            ->select('id', 'name','code')
            ->get();

        $colors = Color::query()
            ->select('id', 'name')
            ->get();

        $cities = City::query()
            ->select('id', 'name')
            ->get();

        return view('site.create', compact('cars'
        , 'fuels', 'gears', 'bans', 'currencies', 'colors', 'cities', 'suppliers'));
    }

}
