<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModule extends Model
{
    use HasFactory;

    protected $table = 'training_books';

    protected $fillable = ['title'];

    // public function modules()
    // {
    //     return $this->hasMany(TrainingBookPartModules::class, 'part_id');
    // }
}
