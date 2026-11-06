<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingBookPartModuleSignoffRequirement extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_signoff_requirements';

    protected $fillable = [
        'book_part_module_id',
        'signer_role',
        'scope',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function bookPartModule(): BelongsTo
    {
        return $this->belongsTo(
            TrainingBookPartModule::class,
            'book_part_module_id'
        );
    }

    public function signoffs(): HasMany
    {
        return $this->hasMany(
            TrainingBookAssignmentSignoff::class,
            'signoff_requirement_id'
        );
    }
}
