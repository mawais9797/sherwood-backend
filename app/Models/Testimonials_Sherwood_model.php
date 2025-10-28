<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonials_Sherwood_model extends Model
{
    use HasFactory;
    protected $table    = 'sherwood_testimonials';
    protected $fillable = [
        'message',
        'name',
        'designation',
        'image',
    ];
}
