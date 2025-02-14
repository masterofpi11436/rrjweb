<?php

namespace App\Models\Directory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneDirectory extends Model
{
    use HasFactory;

    protected $table = 'phone_directory';

    protected $fillable = ['name', 'title', 'section', 'extension'];
}