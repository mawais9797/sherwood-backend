<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msgs_model extends Model
{
    use HasFactory;
    protected $table = 'msgs';
    protected $fillable = [
        'c_id',
        'sender',
        'receiver',
        'msg',
        'message_by',
        'status',
        'type'
    ];
    public function sender_row()
    {
        return $this->belongsTo(Member_model::class,'sender','id');
    }
    public function request_row()
    {
        return $this->hasOne(Msg_requests_model::class, 'msg_id', 'id')->where('parent_id',0)
            ->latest();
    }
    public function request_extension_row()
    {
        return $this->hasOne(Msg_requests_model::class, 'msg_id', 'id')->where('parent_id','!=',0)
            ->latest();
    }
    public function receiver_row()
    {
        return $this->belongsTo(Member_model::class,'receiver','id');
    }
    public function message_by_row()
    {
        return $this->belongsTo(Member_model::class,'message_by','id');
    }
    public function conversation()
    {
        return $this->belongsTo(Conversations_model::class);
    }
    public function msgRequests()
    {
        return $this->hasMany(Msg_requests_model::class, 'msg_id', 'id')->where('parent_id',0);
    }
    public function member()
    {
        return $this->belongsTo(Member_model::class, 'message_by', 'id');
    }
}