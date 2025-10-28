<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services_model extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'title',
        'heading',
        'short_desc',


        'meta_title',
        'meta_description',
        'meta_keywords',
        // 'tags',
        'sec1_title',
        'sec1_heading',
        'sec1_detail',

        'sec2_heading',
        'sec2_detail',


        'image1',
        'image2',

        'status',
        'featured',
        // 'popular',
        'slug',
    ];
}
