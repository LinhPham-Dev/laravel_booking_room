<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes, QueryFilter;

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'image', 'description', 'status'];

    // filter by filed
    protected $filterable = ['name', 'status'];

    // Get categories active
    public function categoryActives()
    {
        return self::where('status', 1)->get();
    }

    // Check the product number belongs to the category
    public function blogOfBlogCategories()
    {
        return $this->hasMany(Blog::class);
    }
}
