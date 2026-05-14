<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterSection extends Model
{
    use HasFactory;

    protected $table = 'policy_chapter_sections';

    protected $fillable = [
        'chapter_id',
        'section_title',
        'sort_order',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function paragraphs()
    {
        return $this->hasMany(ChapterParagraph::class, 'section_id')
            ->orderBy('sort_order');
    }
}
