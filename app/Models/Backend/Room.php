<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

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
}
