<?php

namespace App\Models\Backend;

use App\Traits\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, QueryFilter, SoftDeletes;

    protected $fillable = ['title', 'image', 'content', 'position', 'status'];
}
