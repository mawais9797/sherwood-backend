<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_study_categories_model extends Model
{
    use HasFactory;
    protected $table = 'case_study_categories';
    protected $fillable = [
        'name',
        'status',
        'slug'
    ];
    function Case_study_posts()
    {
        return $this->hasMany(Case_study_model::class, 'category', 'id')->where('status', 1);
    }
}
