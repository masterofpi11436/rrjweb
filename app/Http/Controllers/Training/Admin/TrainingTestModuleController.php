<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TrainingTestModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Tests.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
