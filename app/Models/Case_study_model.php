<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_study_model extends Model
{
    use HasFactory;
    protected $table = 'case_study';
    protected $fillable = [
        'title',
        'heading',
        'category',
        'short_desc',

        'publish_date',
        'reading_time',
        'author_name',



        'meta_title',
        'meta_description',
        'meta_keywords',

        'detail',
        'table_content',

        'image',
        'status',
        'featured',
        'popular',
        'slug',



    ];
    public function category_row()
    {
        return $this->belongsTo(Case_study_categories_model::class, 'category', 'id');
    }
}
