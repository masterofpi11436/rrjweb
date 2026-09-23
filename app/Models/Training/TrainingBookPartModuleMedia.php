<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TrainingBookPartModuleMedia extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_media';

    protected $fillable = ['title', 'description'];

    public function files()
    {
        return $this->hasMany(
            TrainingBookPartModuleMediaFile::class,
            'media_id'
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
