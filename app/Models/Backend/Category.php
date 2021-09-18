<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, QueryFilter;

    protected $fillable = ['name', 'slug', 'image', 'status'];

    // filter by filed
    protected $filterable = ['name', 'status'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // Check the product number belongs to the category
    public function roomOfCategories()
    {
        return $this->hasMany(Room::class);
    }
}
