<?php

namespace App\Models\Mailroom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailroom extends Model
{
    use HasFactory;

    protected $table = 'mailroom';

    protected $fillable = ['inmate_number', 'last_name', 'first_name', 'middle_name'];
}
