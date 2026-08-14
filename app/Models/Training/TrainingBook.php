<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBook extends Model
{
    use HasFactory;

    protected $table = 'training_books';

    protected $fillable = ['title'];

    public function parts()
    {
        return $this->hasMany(TrainingBookPart::class, 'book_id')->orderBy('sort_order');
    }

    public function assignments()
    {
        return $this->hasMany(
            TrainingBookAssignment::class,
            'book_id'
        );
    }
}
