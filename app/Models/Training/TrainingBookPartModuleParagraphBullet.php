<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleParagraphBullet extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_paragraph_bullets';

    protected $fillable = [
        'paragraph_id',
        'type',
        'list',
        'sort_order',
    ];

    protected $casts = [
        'list' => 'array',
    ];

    public function paragraph()
    {
        return $this->belongsTo(
            TrainingBookPartModuleParagraph::class,
            'paragraph_id'
        );
    }
}
