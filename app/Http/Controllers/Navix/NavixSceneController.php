<?php

namespace App\Http\Controllers\Navix;

use App\Http\Controllers\Controller;

class NavixSceneController extends Controller
{
    public function admin()
    {
        return view('Navix.admin', [

            'models' => [

                [
                    'url' => asset('models/Maintenance Building.glb'),
                    'x' => 0,
                    'y' => -1,
                    'z' => 0,
                    'scale' => 5,
                ],
            ],

            'cameraX' => 10,
            'cameraY' => 100,
            'cameraZ' => 0,

            'lightIntensity' => 2,

            'backgroundColor' => '#000000',

        ]);
    }
}