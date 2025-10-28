<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impact_model extends Model
{
    use HasFactory;
    protected $table = 'impact';
    protected $fillable = [
        'title',
        'status',
        'slug',

        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
