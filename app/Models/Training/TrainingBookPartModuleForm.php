<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleForm extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_forms';

    protected $fillable = [
        'title',
        'description',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(
            TrainingBookPartModuleFormDocument::class,
            'form_module_id'
        )->orderBy('sort_order');
    }
}
