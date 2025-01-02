<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    protected $table = 'item_types';

    protected $fillable = ['type'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
