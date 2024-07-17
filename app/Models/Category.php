<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "categories";

    public function new_items()
    {
        return $this->hasMany(NewItem::class , 'category_id');
    }

}
