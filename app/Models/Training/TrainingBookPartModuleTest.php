<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModuleTest extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_module_tests';

    protected $fillable = ['module_id', 'question', 'answers', 'completion_date', 'sort_order'];

    public function module()
    {
        return $this->belongsTo(TrainingBookPartModule::class);
    }
}
