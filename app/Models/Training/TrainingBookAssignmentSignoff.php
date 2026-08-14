<?php

namespace App\Models\Training;

use App\Models\Login\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TrainingBookAssignmentSignoff extends Model
{
    use HasFactory;

    protected $table = 'training_book_assignment_signoffs';

    protected $fillable = [
        'signable_type',
        'signable_id',
        'signoff_requirement_id',
        'signed_by',
        'signed_at',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
    ];

    public function signable(): MorphTo
    {
        return $this->morphTo();
    }

    public function requirement()
    {
        return $this->belongsTo(
            TrainingBookPartModuleSignoffRequirement::class,
            'signoff_requirement_id'
        );
    }

    public function signer()
    {
        return $this->belongsTo(
            User::class,
            'signed_by'
        );
    }
}