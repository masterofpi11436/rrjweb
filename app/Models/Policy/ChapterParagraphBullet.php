<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterParagraphBullet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'policy_chapter_paragraph_bullets';

    public function policyChapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
