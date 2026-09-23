<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class TrainingModuleCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function paragraphs()
    {
        return $this->morphedByMany(
            TrainingBookPartModuleParagraph::class,
            'module',
            'training_module_category_assignments',
            'category_id',
            'module_id'
        );
    }

    public function forms()
    {
        return $this->morphedByMany(
            TrainingBookPartModuleForm::class,
            'module',
            'training_module_category_assignments',
            'category_id',
            'module_id'
        );
    }

    public function media()
    {
        return $this->morphedByMany(
            TrainingBookPartModuleMedia::class,
            'module',
            'training_module_category_assignments',
            'category_id',
            'module_id'
        );
    }

    public function checklists()
    {
        return $this->morphedByMany(
            TrainingBookPartModuleChecklist::class,
            'module',
            'training_module_category_assignments',
            'category_id',
            'module_id'
        );
    }

    public function evaluations()
    {
        return $this->morphedByMany(
            TrainingBookPartModuleEvaluation::class,
            'module',
            'training_module_category_assignments',
            'category_id',
            'module_id'
        );
    }

    public function sopChecklists()
    {
        return $this->morphedByMany(
            TrainingBookPartModuleSOPChecklist::class,
            'module',
            'training_module_category_assignments',
            'category_id',
            'module_id'
        );
    }

    public function tests()
    {
        return $this->morphedByMany(
            TrainingBookPartModuleTest::class,
            'module',
            'training_module_category_assignments',
            'category_id',
            'module_id'
        );
    }
}
