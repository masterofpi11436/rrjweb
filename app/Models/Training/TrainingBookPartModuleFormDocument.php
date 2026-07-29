<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingBookPartModuleFormDocument extends Model
{
    protected $table =
        'training_book_part_module_form_documents';

    protected $fillable = [
        'form_module_id',
        'title',
        'file_path',
        'original_file_name',
        'file_size',
        'sort_order',
    ];

    public function formModule(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModuleForm::class,
            'form_module_id'
        );
    }
}
