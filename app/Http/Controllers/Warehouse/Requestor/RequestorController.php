<?php

namespace App\Http\Controllers\Warehouse\Requestor;

// Base Controller
use App\Http\Controllers\Controller;

// This class only shows the dashboard for the warehouse manager.
class RequestorController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.Requestor.requestor.dashboard');
    }
}
