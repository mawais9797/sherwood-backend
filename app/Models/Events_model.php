<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events_model extends Model
{
    use HasFactory;
    protected $table    = 'events';
    protected $fillable = [
        'title',
        'description',
        'date',
        'start_time',
        'end_time',
        'image',
    ];
}
