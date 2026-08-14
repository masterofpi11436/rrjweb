<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleSignoffRequirement extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_signoff_requirements';

    protected $fillable = [
        'book_part_module_id',
        'signer_role',
        'scope',
        'sort_order',
    ];

    public function bookPartModule()
    {
        return $this->belongsTo(
            TrainingBookPartModule::class,
            'book_part_module_id'
        );
    }

    public function signoffs()
    {
        return $this->hasMany(
            TrainingBookAssignmentSignoff::class,
            'signoff_requirement_id'
        );
    }
}