<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterParagraph extends Model
{
    use HasFactory;

    protected $table = 'policy_chapter_paragraphs';

    protected $fillable = [
        'chapter_id',
        'paragraph',
        'sort_order',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function bullets()
    {
        return $this->hasMany(ChapterParagraphBullet::class, 'paragraph_id')
            ->orderBy('sort_order');
    }
}