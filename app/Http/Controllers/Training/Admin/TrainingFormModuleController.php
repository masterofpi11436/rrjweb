<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TrainingFormModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Forms.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        return view('Training.Admin.Modules.Forms.edit', [
            'formId' => $id,
        ]);
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
