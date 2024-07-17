<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "new_items";

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(NewItemComment::class , 'new_item_id');
    }

}
