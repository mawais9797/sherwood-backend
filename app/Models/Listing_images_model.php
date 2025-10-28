<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_images_model extends Model
{
    use HasFactory;
    protected $table = 'listing_images';
    protected $fillable = [
        'listing_id',
        'image',
    ];
    public function category_row()
    {
        return $this->belongsTo(Listings_model::class,'listing_id','id');
    }
    public function listing()
    {
        return $this->belongsTo(Listings_model::class, 'listing_id', 'id');
    }

}