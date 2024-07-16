<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $client = Auth::guard('client_login')->user()->client_id;
        Project::where('client_id', $client_id)->get();

        return view('client_account.project.list', compact($client));
    }
}
