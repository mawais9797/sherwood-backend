<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings_model extends Model
{
    use HasFactory;
    protected $table = 'listings';
    protected $fillable = [
        'mem_id',
        'title',
        'category',
        'price',
        'item_value',
        'description',
        'address',
        'featured',
        'slug',
        'location',
        'latitude',
        'longitude'
    ];
    public function category_row()
    {
        return $this->belongsTo(Categories_model::class,'category','id');
    }
    public function member_row()
    {
        return $this->belongsTo(Member_model::class,'mem_id','id');
    }
    function images(){
        return $this->hasMany(Listing_images_model::class,'listing_id','id');
    }
    public function singleFirstImage()
    {
        return $this->hasOne(Listing_images_model::class, 'listing_id', 'id')
            ->latest();
    }
    public function listingImages()
    {
        return $this->hasMany(Listing_images_model::class, 'listing_id', 'id');
    }
    public function firstListingImage()
    {
        return $this->hasOne(Listing_images_model::class, 'listing_id', 'id')->oldestOfMany();
    }
    public function bookings()
    {
        return $this->hasManyThrough(Booking_model::class, Msg_requests_model::class, 'listing_id', 'request_id', 'id', 'id');
    }
    public function msgRequests()
    {
        return $this->hasMany(Msg_requests_model::class, 'listing_id', 'id')->where('parent_id',0);
    }
    public function requests()
    {
        return $this->hasMany(Msg_requests_model::class);
    }
    public function bookingsWithDates()
    {
        return $this->requests()->with('bookings');
    }

}