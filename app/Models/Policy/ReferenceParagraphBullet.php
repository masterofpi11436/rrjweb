<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceParagraphBullet extends Model
{
    use HasFactory;

    protected $table = 'policy_reference_paragraph_bullets';

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
        return $this->belongsTo(ReferenceParagraph::class, 'paragraph_id');
    }
}
