<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleMedia extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_media';

    protected $fillable = ['title', 'description'];

    public function files()
    {
        return $this->hasMany(
            TrainingBookPartModuleMediaFile::class,
            'media_id'
        )->orderBy('sort_order');
    }
}
