<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModule extends Model
{
    protected $fillable = [
        'book_part_id',
        'module_type',
        'module_id',
        'sort_order',
    ];

    public function part()
    {
        return $this->belongsTo(
            TrainingBookPart::class,
            'book_part_id'
        );
    }

    public function module()
    {
        return $this->morphTo();
    }
}
