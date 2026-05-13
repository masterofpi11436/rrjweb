<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterParagraph extends Model
{
    use HasFactory;

    protected $table = 'policy_chapter_paragraphs';

    protected $fillable = ['chapter_id ', 'paragraph', 'sort_order'];

    public function policyChapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function chapterParagraphBullet()
    {
        return $this->hasMany(ChapterParagraphBullet::class)->orderBy('sort_order');
    }
}
