<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceSection extends Model
{
    use HasFactory;

    protected $table = 'policy_reference_sections';

    protected $fillable = [
        'reference_id',
        'section_title',
        'sort_order',
    ];

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'reference_id');
    }

    public function paragraphs()
    {
        return $this->hasMany(ReferenceParagraph::class, 'section_id')
            ->orderBy('sort_order');
    }
}
