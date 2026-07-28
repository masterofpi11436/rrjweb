<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleParagraph extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_paragraphs';

    protected $fillable = [
        'title',
        'content',
        'sort_order',
    ];

    public function bullets()
    {
        return $this->hasMany(
            TrainingBookPartModuleParagraphBullet::class,
            'paragraph_id',
            'id'
        )->orderBy('sort_order');
    }
}
