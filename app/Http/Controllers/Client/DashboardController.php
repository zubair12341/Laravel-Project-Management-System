<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $client = Auth::guard('client_login')->user();
        dd($client->fullname);

        return view('client_account.dashboard', compact('client'));
    }
}
