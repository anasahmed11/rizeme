<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewItemComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "new_item_comments";

    public function new_item()
    {
        return $this->belongsTo(NewItem::class , 'new_item_id');
    }


}
