<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceParagraph extends Model
{
    use HasFactory;

    protected $table = 'policy_reference_paragraphs';

    protected $fillable = [
        'reference_id',
        'aca_reference',
        'paragraph',
        'sort_order',
    ];

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference_id');
    }

    public function bullets()
    {
        return $this->hasMany(ReferenceParagraphBullet::class, 'paragraph_id')
            ->orderBy('sort_order');
    }
}
