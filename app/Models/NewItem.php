<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "new_items";

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(NewItemComment::class, 'new_item_id');
    }

    public function save(array $options = [])
    {
        $now = Carbon::now();

        // Check if publish_at is in the future or null
        if (!is_null($this->publish_at) && Carbon::parse($this->publish_at)->gt($now)) {
            $this->published = false;
        } else {
            $this->published_at = $now;
            $this->published = true;
        }

        return parent::save($options);
    }

    public function update(array $attributes = [], array $options = [])
    {
        $now = Carbon::now();

        // Check if publish_at is in the future or null
        if (isset($attributes['publish_at'])) {
            if (!is_null($attributes['publish_at']) && Carbon::parse($attributes['publish_at'])->gt($now)) {
                $this->published = false;
                $this->published_at = null;
            } else {
                $this->published_at = $now;
                $this->published = true;
            }
        }

        return parent::update($attributes, $options);
    }

}
