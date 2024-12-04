<?php

namespace App\Http\Controllers\OPR;

// Base Controller
use App\Http\Controllers\Controller;

class OPRListController extends Controller
{
    public function dashboard()
    {
        return view('OPR.OPRList.dashboard');
    }
}
