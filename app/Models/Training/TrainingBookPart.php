<?php

namespace App\Models\Training;

use App\Models\Training\TrainingBookPartModule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPart extends Model
{
    use HasFactory;

    protected $table = 'training_books';

    protected $fillable = ['title'];

    public function modules()
    {
        return $this->hasMany(TrainingBookPartModule::class, 'part_id');
    }
}
