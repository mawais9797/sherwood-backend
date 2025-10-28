<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects_model extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',

        'category',

        'title',
        'heading',
        'short_desc',

        'image1',


        'detail',
        'description',
        'description2',
        'description3',



        'status',
        'featured',
        'slug',



    ];
    public function category_row()
    {
        return $this->belongsTo(Project_categories_model::class, 'category', 'id');
    }
}
