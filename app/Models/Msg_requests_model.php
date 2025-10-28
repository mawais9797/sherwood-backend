<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg_requests_model extends Model
{
    use HasFactory;
    protected $table = 'msg_requests';
    protected $fillable = [
        'msg_id',
        'listing_id',
        'start_date',
        'end_date',
        'amount',
        'status',
        'parent_id'
    ];
    public function msg_row()
    {
        return $this->belongsTo(Msgs_model::class,'msg_id','id');
    }
    public function listing_row()
    {
        return $this->belongsTo(Listings_model::class,'listing_id','id');
    }
    public function msg()
    {
        return $this->belongsTo(Msgs_model::class, 'msg_id', 'id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking_model::class, 'request_id', 'id');
    }
    public function booking_row()
    {
        return $this->hasOne(Booking_model::class, 'request_id', 'id');
    }
    public function listing()
    {
        return $this->belongsTo(Listings_model::class, 'listing_id', 'id');
    }
    public function request_parent_row(){
        return $this->belongsTo(Msg_requests_model::class, 'parent_id', 'id');
    }
}