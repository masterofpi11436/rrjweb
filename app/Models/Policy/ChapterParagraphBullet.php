<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterParagraphBullet extends Model
{
    use HasFactory;

    protected $table = 'policy_chapter_paragraph_bullets';

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
        return $this->belongsTo(ChapterParagraph::class, 'paragraph_id');
    }
}