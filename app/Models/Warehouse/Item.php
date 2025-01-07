<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse\ItemType;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['name', 'item_type_id', 'image', 'quantity'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
