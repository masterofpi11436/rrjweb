<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModule extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_modules';

    protected $fillable = [
        'book_part_id',
        'module_type',
        'module_id',
        'sort_order',
    ];

    public function part()
    {
        return $this->belongsTo(
            TrainingBookPart::class,
            'book_part_id'
        );
    }

    public function module()
    {
        return $this->morphTo();
    }

    public function signoffRequirements()
    {
        return $this->hasMany(
            TrainingBookPartModuleSignoffRequirement::class,
            'book_part_module_id'
        )->orderBy('sort_order');
    }

    public function assignmentModules()
    {
        return $this->hasMany(
            TrainingBookAssignmentModule::class,
            'book_part_module_id'
        );
    }
}