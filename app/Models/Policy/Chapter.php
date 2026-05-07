<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'policy_chapters';

    public function policyBuilder()
    {
        return $this->belongsTo(PolicyBuilder::class, 'policy_builder_id');
    }

    public function chapterParagraph()
    {
        return $this->hasMany(ChapterParagraph::class, 'policy_chapter_id')->orderBy('sort_order');
    }
}
