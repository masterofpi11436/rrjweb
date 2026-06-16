<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterParagraphBulletBullet extends Model
{
    use HasFactory;

    protected $table = 'policy_chapter_paragraph_bullet_bullets';

    protected $fillable = [
        'bullet_id',
        'type',
        'list',
        'sort_order',
    ];

    protected $casts = [
        'list' => 'array',
    ];

    public function bullet()
    {
        return $this->belongsTo(ChapterParagraphBullet::class, 'bullet_id');
    }
}
