<?php

namespace App\Http\Controllers\Tablet;

use Illuminate\Http\Request;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Tablet\InmateTablet;

class InmateTabletController extends Controller
{
    public function index(Request $request)
    {
        $tablets = $request->input('search');

        if ($tablets) {
            $tablets = InmateTablet::where('last_name', 'like', '%' . $search . '%')
                                    ->orWhere('first_name', 'like', '%' . $search . '%')
                                    ->orWhere('inmate_number', 'like', '%' . $search . '%')
                                    ->orderBy('created_at')
                                    ->get();
        }
        return view('Tablet.InmateTablet.index');
    }
}
