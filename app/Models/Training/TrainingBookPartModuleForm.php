<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TrainingBookPartModuleForm extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_forms';

    protected $fillable = [
        'title',
        'description',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleFormDocument::class,
            'form_module_id'
        )->orderBy('sort_order');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            TrainingModuleCategory::class,
            'module',
            'training_module_category_assignments',
            'module_id',
            'category_id'
        );
    }
}
