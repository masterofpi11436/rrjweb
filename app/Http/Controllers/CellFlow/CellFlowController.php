<?php

namespace App\Http\Controllers\CellFlow;

use App\Http\Controllers\Controller;

class CellFlowController extends Controller
{
    public function dashboard()
    {
        return view('CellFlow.Admin.dashboard');
    }
}