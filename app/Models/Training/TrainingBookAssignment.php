<?php

namespace App\Models\Training;

use App\Models\Login\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookAssignment extends Model
{
    use HasFactory;

    protected $table = 'training_book_assignments';

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'assigned_at',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function book()
    {
        return $this->belongsTo(
            TrainingBook::class,
            'book_id'
        );
    }

    public function modules()
    {
        return $this->hasMany(
            TrainingBookAssignmentModule::class,
            'assignment_id'
        );
    }
}