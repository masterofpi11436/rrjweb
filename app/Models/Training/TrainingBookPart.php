<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPart extends Model
{
    use HasFactory;

    protected $table = 'training_book_parts';

    protected $fillable = ['title', 'book_id', 'sort_order'];

    public function book()
    {
        return $this->belongsTo(TrainingBook::class);
    }

    public function modules()
    {
        return $this->hasMany(TrainingBookPartModule::class, 'book_part_id')->orderBy('sort_order');
    }
}
