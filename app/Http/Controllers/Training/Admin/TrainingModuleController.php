<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleChecklist;
use App\Models\Training\TrainingBookPartModuleForm;
use App\Models\Training\TrainingBookPartModuleMedia;
use App\Models\Training\TrainingBookPartModuleParagraph;
use App\Models\Training\TrainingBookPartModuleSOPChecklist;
use App\Models\Training\TrainingBookPartModuleTest;

class TrainingModuleController extends Controller
{
    public function dashboard()
    {
        return view('Training.Admin.Modules.dashboard', [
            'paragraphModules' => TrainingBookPartModuleParagraph::latest()->get(),
            'formModules' => TrainingBookPartModuleForm::latest()->get(),
            'mediaModules' => TrainingBookPartModuleMedia::latest()->get(),
            'checklistModules' => TrainingBookPartModuleChecklist::latest()->get(),
            'sopChecklistModules' => TrainingBookPartModuleSOPChecklist::latest()->get(),
            'testModules' => TrainingBookPartModuleTest::latest()->get(),
        ]);
    }
}