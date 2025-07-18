<?php

namespace App\Http\Controllers\Dashboard\SiteUser;

use App\Http\Controllers\Controller;
use App\Models\SiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteUserController extends Controller
{
    public function index()
    {
        $users = SiteUser::query()
            ->whereNotNull('email_verified_at')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('dashboard.siteuser.index', compact('users'));
    }
}
