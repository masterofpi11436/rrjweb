<?php

namespace App\Models\OPR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPRList extends Model
{
    use HasFactory;

    protected $table = 'OPRList';

    protected $fillable = ['inmate_number', 'last_name', 'first_name', 'middle_name'];
}
