<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleMediaFile extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_media_files';

    protected $fillable = ['media_id', 'type', 'title', 'file', 'sort_order'];

    public function media()
    {
        return $this->belongsTo(
            TrainingBookPartModuleMedia::class,
            'media_id'
        );
    }
}
