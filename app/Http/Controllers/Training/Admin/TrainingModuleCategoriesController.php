<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingModuleCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingModuleCategoriesController extends Controller
{
    public function index(): View
    {
        $categories = TrainingModuleCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'Training.Admin.Modules.Categories.index',
            compact('categories')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:training_module_categories,name',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $sortOrder =
            TrainingModuleCategory::max('sort_order') ?? -1;

        TrainingModuleCategory::create([
            'name' => $validated['name'],

            'description' =>
                $validated['description'] ?? null,

            'sort_order' => $sortOrder + 1,
        ]);

        return back()->with(
            'success',
            'Module category created successfully.'
        );
    }

    public function update(
        Request $request,
        TrainingModuleCategory $category
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:training_module_categories,name,'
                    . $category->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $category->update([
            'name' => $validated['name'],

            'description' =>
                $validated['description'] ?? null,
        ]);

        return back()->with(
            'success',
            'Module category updated successfully.'
        );
    }

    public function destroy(
        TrainingModuleCategory $category
    ): RedirectResponse {
        $category->delete();

        return back()->with(
            'success',
            'Module category deleted successfully.'
        );
    }
}
