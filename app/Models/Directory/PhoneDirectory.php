<?php

namespace App\Models\Directory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneDirectory extends Model
{
    // use HasFactory;

    protected $connection = 'phone';
    protected $table = 'phone';
    public $timestamps = false;

    protected $fillable = ['name', 'title', 'section', 'extension'];
}
