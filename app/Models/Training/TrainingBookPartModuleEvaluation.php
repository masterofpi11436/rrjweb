<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleEvaluation extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_evaluations';

    protected $fillable = [
        'title',
        'description',
    ];
}