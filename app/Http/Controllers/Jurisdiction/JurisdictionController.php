<?php

namespace App\Http\Controllers\Jurisdiction;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Jurisdiction\Jurisdiction;
use App\Models\Jurisdiction\JurisdictionTimeLog;

class JurisdictionController extends Controller
{
    public function dashboard()
    {
        return view('Jurisdiction.jurisdiction.dashboard');
    }
}
