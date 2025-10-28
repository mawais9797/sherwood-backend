<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trusted_by_model extends Model
{
    use HasFactory;
    protected $table = 'trusted_by';
    protected $fillable = [
        // 'title',
        // 'category',
        // 'meta_title',
        // 'meta_description',
        // 'meta_keywords',
        // 'tags',
        // 'detail',
        'image',
        'status',
        // 'featured',
        // 'popular',
        // 'slug',
    ];
}
