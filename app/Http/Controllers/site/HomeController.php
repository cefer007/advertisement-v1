<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::query()
            ->get();
        return view('site.home', compact('cars'));
    }

}
