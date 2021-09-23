<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes, QueryFilter;

    protected $fillable = ['name', 'image', 'category_id', 'slug', 'price', 'sale_price', 'status', 'bed', 'bath', 'area', 'description'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // Category of room
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Image detail
    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function scopeRoomByCategory($query)
    {
        $slug = request()->slug;

        if ($slug) {
            // Get category by slug
            $category = Category::where('slug', $slug)->first();
            // Check category exits
            if ($category) {
                $query = Room::where('category_id', $category->id);
            }
        }

        return $query;
    }
}
