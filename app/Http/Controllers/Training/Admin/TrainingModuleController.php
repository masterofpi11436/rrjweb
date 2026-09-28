<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleChecklist;
use App\Models\Training\TrainingBookPartModuleEvaluation;
use App\Models\Training\TrainingBookPartModuleForm;
use App\Models\Training\TrainingBookPartModuleMedia;
use App\Models\Training\TrainingBookPartModuleParagraph;
use App\Models\Training\TrainingBookPartModuleSOPChecklist;
use App\Models\Training\TrainingBookPartModuleTest;
use App\Models\Training\TrainingModuleCategory;
use Illuminate\Http\Request;

class TrainingModuleController extends Controller
{
    public function dashboard(Request $request)
    {
        $categoryId = $request->integer('category');

        return view('Training.Admin.Modules.dashboard', [
            'categories' => TrainingModuleCategory::query()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            'selectedCategory' => $categoryId,

            'paragraphModules' => $this->getModules(
                TrainingBookPartModuleParagraph::class,
                $categoryId
            ),

            'formModules' => $this->getModules(
                TrainingBookPartModuleForm::class,
                $categoryId
            ),

            'mediaModules' => $this->getModules(
                TrainingBookPartModuleMedia::class,
                $categoryId
            ),

            'checklistModules' => $this->getModules(
                TrainingBookPartModuleChecklist::class,
                $categoryId
            ),

            'evaluationModules' => $this->getModules(
                TrainingBookPartModuleEvaluation::class,
                $categoryId
            ),

            'sopChecklistModules' => $this->getModules(
                TrainingBookPartModuleSOPChecklist::class,
                $categoryId
            ),

            'testModules' => $this->getModules(
                TrainingBookPartModuleTest::class,
                $categoryId
            ),
        ]);
    }

    private function getModules(string $modelClass, ?int $categoryId)
    {
        return $modelClass::query()
            ->with('categories')
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('categories', function ($categoryQuery) use ($categoryId) {
                    $categoryQuery->where(
                        'training_module_categories.id',
                        $categoryId
                    );
                });
            })
            ->latest()
            ->get();
    }
}
