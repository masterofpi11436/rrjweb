<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterParagraph extends Model
{
    use HasFactory;

    protected $table = 'policy_chapter_paragraphs';

    public function policyChapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function chapterParagraphBullet()
    {
        return $this->hasMany(ChapterParagraphBullet::class)->orderBy('sort_order');
    }
}
