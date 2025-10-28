<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans_model extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = [
        'stripe_id',
        'name',
        'plan_type',
        'price',
        'txt1',
        'txt2',
        'txt1',
        'status',
        // 'image',
        // 'slug'
    ];
}
