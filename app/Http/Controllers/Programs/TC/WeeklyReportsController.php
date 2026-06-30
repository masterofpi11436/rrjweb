<?php

namespace App\Http\Controllers\Programs\TC;

// Base Controller
use App\Http\Controllers\Controller;

// Models required
use App\Models\Mailroom\Mailroom;

class WeeklyReportsController extends Controller
{
    // Login Required Pages
    public function monthlyDashboard()
    {

        $caseworkers = [
            [
                'id' => 1,
                'name' => 'Giles',
                'area' => 'HU 1/5',
            ],
            [
                'id' => 2,
                'name' => 'Plaskett',
                'area' => 'HU 2 / 4A MH',
            ],
            [
                'id' => 3,
                'name' => 'Peterkin',
                'area' => 'HU 2',
            ],
        ];

        $counselors = [
            [
                'id' => 4,
                'name' => 'Smith',
                'area' => 'Counseling',
            ],
        ];

        return view('Programs.TC.monthly-dashboard', compact(
            'caseworkers',
            'counselors'
        ));
    }
}
