<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBookPartModule extends Model
{
    use HasFactory;

    protected $table = 'training_book_part_modules';

    protected $fillable = ['title', 'book_part_id', 'sort_order'];

    public function part()
    {
        return $this->belongsTo(TrainingBookPart::class);
    }

    public function checklists()
    {
        return $this->hasMany(TrainingBookPartModuleChecklist::class, 'module_id');
    }

    public function forms()
    {
        return $this->hasMany(TrainingBookPartModuleForm::class, 'module_id');
    }

    public function medias()
    {
        return $this->hasMany(TrainingBookPartModuleMedia::class, 'module_id');
    }

    public function sopChecklists()
    {
        return $this->hasMany(TrainingBookPartModuleSOPChecklist::class, 'module_id');
    }

    public function tests()
    {
        return $this->hasMany(TrainingBookPartModuleTest::class, 'module_id');
    }

    public function paragraphs()
    {
        return $this->hasMany(TrainingBookPartModuleParagraph::class, 'module_id');
    }
}
