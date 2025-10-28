<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories_model;
use App\Models\Listings_model;
use App\Models\Listing_images_model;
use App\Models\Locations_model;
use App\Models\States_model;
use App\Models\Conversations_model;
use App\Models\Msgs_model;
use App\Models\Msg_requests_model;
use Illuminate\Support\Str;


class Listing extends Controller
{
    
    public function single_listing(Request $request,$id){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $this->data['member']=$member;
            $this->data['categories']=Categories_model::orderBy('id', 'DESC')->where('status',1)->get();
            $id=doDecode($id);
            if(intval($id) > 0 && $listing=Listings_model::where('id',$id)->get()->first()){
                $listing->encoded_id=doEncode($listing->id);
                $listing->images=$listing->images;
                $this->data['listing']=$listing;
            }
            $this->data['locations']=Locations_model::orderBy('id', 'DESC')->where('status',1)->get();
        }

        exit(json_encode($this->data));
    }
    public function listings(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $this->data['member']=$member;
            $this->data['listings']=Listings_model::orderBy('id', 'DESC')->where('mem_id',$member->id)->get();
            foreach($this->data['listings'] as $listing){
                $listing->encoded_id=doEncode($listing->id);
                $listing->images=$listing->images;
                $listing->cat_name=!empty($listing->category_row) ? $listing->category_row->name : "N/A";
            }
        }

        exit(json_encode($this->data));
    }
    public function add_listing(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $request_data = [
                'title' => 'required',
                'category' => 'required',
                'price' => 'required',
                'item_value' => 'required',
                'description' => 'required',
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'location' => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                $images=$input['images'];
                
                $data=array(
                    'title'=>$input['title'],
                    'slug'=>checkSlug(Str::slug($input['title'], '-'),'listings'),
                    'category'=>$input['category'],
                    'price'=>$input['price'],
                    'item_value'=>$input['item_value'],
                    'description'=>$input['description'],
                    'location'=>$input['location'],
                    'address'=>$input['address'],
                    'latitude'=>$input['latitude'],
                    'longitude'=>$input['longitude'],
                    'mem_id'=>$member->id
                );
                $id=Listings_model::create($data);
                $listing_id=$id->id;
                if($listing_id > 0){
                    foreach($images as $image){
                        $image=json_decode($image);
                        $image_data=array( 
                            'image'=>$image->file_name,
                            'listing_id'=>$listing_id
                        );
                        Listing_images_model::create($image_data);
                    }
                    $res['status']=1;
                    $res['msg']='Listing added successfully!';
                }
                else{
                    $res['msg']='Technical problem!';
                }
            }
        }
        exit(json_encode($res));
    }
    public function edit_listing(Request $request,$id){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        $id=doDecode($id);
        $listing=Listings_model::where('id',$id)->get()->first();
        if(empty($listing)){
            $res['msg']='Listing is invalid!';
            exit(json_encode($res));
        }
        if(!empty($member)){
            $input = $request->all();
            $request_data = [
                'title' => 'required',
                'category' => 'required',
                'price' => 'required',
                'item_value' => 'required',
                'description' => 'required',
                'location' => 'required',
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                $images=$input['images'];
                
                $data=array(
                    'title'=>$input['title'],
                    'slug'=>checkSlug(Str::slug($input['title'], '-'),'listings',$listing->id),
                    'category'=>$input['category'],
                    'price'=>$input['price'],
                    'item_value'=>$input['item_value'],
                    'description'=>$input['description'],
                    'address'=>$input['address'],
                    'latitude'=>$input['latitude'],
                    'longitude'=>$input['longitude'],
                    'location'=>$input['location'],
                );
                Listings_model::where('id',$listing->id)->update($data);
                $listing_id=$id;
                if($listing_id > 0){
                    if(!empty($images)){
                        Listing_images_model::where('listing_id',$listing_id)->delete();
                        foreach($images as $image){
                            $image=json_decode($image);
                            $image_data=array( 
                                'image'=>$image->file_name,
                                'listing_id'=>$listing_id
                            );
                            Listing_images_model::create($image_data);
                        } 
                    }
                    
                    $res['status']=1;
                    $res['msg']='Listing updated successfully!';
                }
                else{
                    $res['msg']='Technical problem!';
                }
            }
        }
        exit(json_encode($res));
    }
    function delete_listing(Request $request,$id){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(intval($id) > 0 && $listing=Listings_model::where(['mem_id' => $member->id,'id'=>intval($id)])->get()->first()){
            $listing->delete();
            Listing_images_model::where('listing_id',$id)->delete();
            $res['status']=1;
            $res['msg']="Listing deleted successfully!";
        }
        else{
            $res['msg']="Listing does not exist";
        }
        exit(json_encode($res));


    }
    public function explore_search(Request $request){
        $token=$request->input('token', null);
        $search_query=$request->input('query', null);
        $locations=$request->input('location', null);
        $categories=$request->input('categories', null);
        $input = $request->all();
        $this->data['input']=$input;
        $this->data['search_query']=$search_query;
        $member=$this->authenticate_verify_token($token);
        $this->data['states']=States_model::with('locations')->has('locations')
        ->orderBy('name', 'ASC')
        ->get();
        $this->data['featured_locations']=Locations_model::orderBy('id', 'DESC')->where('status',1)->where('featured',1)->get();
        $this->data['categories']=Categories_model::orderBy('id', 'DESC')->where('status',1)->get();
        $listings_query= Listings_model::leftJoin('categories', 'categories.id', '=', 'listings.category')
        ->leftJoin('locations', 'locations.id', '=', 'listings.location')
        ->orderBy('listings.id', 'DESC')
        ->where(function($query) use ($search_query, $categories,$locations) {
            if (!empty($search_query)) {
                $query->where('listings.title', 'like', "%$search_query%");
                $query->orWhere('categories.name', 'like', "%$search_query%");
                $query->orWhere('locations.name', 'like', "%$search_query%");
            }

            // Check if $categories is not empty before applying the whereIn filter
            if (!empty($categories)) {
                $categories=explode(",",$categories);
                $query->whereIn('listings.category', $categories);
            }
            if (!empty($locations)) {
                $locations=explode(",",$locations);
                $query->whereIn('listings.location', $locations);
            }
        });
        $this->data['listings']= $listings_query->get('listings.*');
        $p_sql = Str::replaceArray('?', $listings_query->getBindings(), $listings_query->toSql());
        $this->data['p_sql']=$p_sql;
        foreach($this->data['listings'] as $listing){
            $listing->encoded_id=doEncode($listing->id);
            $listing->images_arr=$listing->images->take(4);
            $listing->cat_name=!empty($listing->category_row) ? $listing->category_row->name : "N/A";
            if(!empty($listing->member_row)){
                if(!empty($listing->member_row->mem_display_name)){
                    $listing->mem_name=$listing->member_row->mem_display_name; 
                }
                else{
                    $mem_name=$listing->member_row->mem_fullname;
                    $mem_name=explode(" ",$mem_name);
                    $listing->mem_name=$mem_name[0]; 
                }
                
            }
        }

        exit(json_encode($this->data));
    }
    public function explore_listing_details_page(Request $request,$slug){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        // if(!empty($member)){
            $this->data['member']=$member;
            $this->data['categories']=Categories_model::orderBy('id', 'DESC')->where('status',1)->get();
            if(!empty($slug) && $listing=Listings_model::with('bookings')->where('slug',$slug)->get()->first()){
                $listing->encoded_id=doEncode($listing->id);
                $bookedDates = [];
                foreach ($listing->msgRequests as $request) {
                    $dates = getDatesBtweenTwoDates($request->start_date, $request->end_date);
                    $bookedDates = array_merge($bookedDates, $dates);
                }
                $listing->bookedDates=$bookedDates;
                $listing->bookings=$listing->bookings;
                $listing->images=$listing->images;
                $listing->cat_name=!empty($listing->category_row) ? $listing->category_row->name : "N/A";
                if(!empty($listing->member_row)){
                    $listing->mem_image=$listing->member_row->mem_image;
                    $mem_name=$listing->member_row->mem_fullname;
                    $mem_name=explode(" ",$mem_name);
                    $listing->mem_name=$mem_name[0];
                }
                $listing_booked_dates=array();
                $bookings_arr=Msg_requests_model::where('listing_id',$listing->id)->where('status','confirmed')->get();
                foreach($bookings_arr as $booking){
                    $dates_res=getDatesBtweenTwoDates($booking->start_date,$booking->end_date);
                    foreach($dates_res as $dateObj){
                        $listing_booked_dates[]=$dateObj;
                    }
                }
                $listing->listing_booked_dates=$listing_booked_dates;
                $this->data['listing']=$listing;
            }
        // }

        exit(json_encode($this->data));
    }
    public function checkRentalItemAvailability(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $listing_id=doDecode($input['listing_id']);
            $startDate=date('Y-m-d',strtotime($input['start_date']));
            $endDate=date('Y-m-d',strtotime($input['end_date']));
            $overlappingBookings = Msg_requests_model::where('listing_id',$listing_id)->where('status','confirmed')->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function($query) use ($startDate, $endDate) {
                          $query->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                      });
            })->exists();
            if($overlappingBookings){
                $res['msg']='These dates are already booked!';
            }
            else{
                $res['status']=1;
            }
        }
        
        exit(json_encode($res));
    }
    public function send_msg_owner(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $request_data = [
                'msg' => 'required',
                'listing_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                if(intval($input['listing_id']) > 0 && $listing=Listings_model::where('id',intval($input['listing_id']))->get()->first()){
                    $startDate=date('Y-m-d',strtotime($input['start_date']));
                    $endDate=date('Y-m-d',strtotime($input['end_date']));
                    $overlappingBookings = Msg_requests_model::where('listing_id',$listing->id)->where('status','confirmed')->where(function($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_date', [$startDate, $endDate])
                              ->orWhereBetween('end_date', [$startDate, $endDate])
                              ->orWhere(function($query) use ($startDate, $endDate) {
                                  $query->where('start_date', '<=', $startDate)
                                        ->where('end_date', '>=', $endDate);
                              });
                    })->exists();
                    if($overlappingBookings){
                        $res['msg']='These dates are already booked. Please choose different dates';
                        exit(json_encode($res));
                    }
                    $num_of_days=calculateDaysBetween($input['start_date'],$input['end_date']);
                    if(!empty($listing->member_row)){
                        $listing_member=$listing->member_row;
                        $already_exist=Conversations_model::where(function ($query) use ($member) {
                            $query->where('sender', $member->id)
                                ->orWhere('receiver', $member->id);
                        })->where(function ($query) use ($listing_member) {
                            $query->where('sender', $listing_member->id)
                                ->orWhere('receiver', $listing_member->id);
                        })->get()->first();
                        if(!empty($already_exist)){
                            $c_id=$already_exist->id;
                            if($c_id > 0){
                                $m_msg=array(
                                    'c_id'=>$c_id,
                                    'sender'=>$member->id,
                                    'receiver'=>$listing_member->id,
                                    'msg'=>!empty($input['msg']) && $input['msg']!=null ? $input['msg'] : "Hi",
                                    'message_by'=>$member->id,
                                    'status'=>'sent',
                                    'type'=>'request',
                                    'created_at'=>date("Y-m-d H:i:s")
                                );
                                $message_id=Msgs_model::create($m_msg);
                                $msg_id=$message_id->id;
                                if($msg_id > 0){
                                    $request_Data=array(
                                        'msg_id'=>$msg_id,
                                        'listing_id'=>$listing->id,
                                        'start_date'=>date('Y-m-d',strtotime($input['start_date'])),
                                        'end_date'=>date('Y-m-d',strtotime($input['end_date'])),
                                        'amount'=>floatval($listing->price) * intval($num_of_days),
                                        'status'=>'pending'
                                    );
                                    Msg_requests_model::create($request_Data);
                                    create_notification(array(
                                        'mem_id'=>$listing->mem_id,
                                        'text'=>$member->mem_fullname." has sent you a booking request for <strong>".$listing->title."</strong>. To view details, <a href='".config('app.react_url')."/dashboard/inbox/".doEncode($c_id)."'>Click Here</a>",
                                        'status'=>0,
                                        'sender'=>$member->id,
                                    ));
                                    $res['status']=1;
                                    $res['msg']='Message sent successfully!';
                                }
                               
                            }
                            else{
                                $res['msg']='Technical problem!';
                            }
                        }
                        else{
                            $c_data=array(
                                'sender'=>$member->id,
                                'receiver'=>$listing_member->id,
                                'status'=>'open',
                            );
                            $conversation=Conversations_model::create($c_data);
                            $c_id=$conversation->id;
                            if($c_id > 0){
                                $m_msg=array(
                                    'c_id'=>$c_id,
                                    'sender'=>$member->id,
                                    'receiver'=>$listing_member->id,
                                    'msg'=>!empty($input['msg']) && $input['msg']!=null ? $input['msg'] : "Hi",
                                    'message_by'=>$member->id,
                                    'status'=>'sent',
                                    'type'=>'request',
                                    'created_at'=>date("Y-m-d H:i:s")
                                );
                                $message_id=Msgs_model::create($m_msg);
                                $msg_id=$message_id->id;
                                $request_Data=array(
                                    'msg_id'=>$msg_id,
                                    'listing_id'=>$listing->id,
                                    'start_date'=>date('Y-m-d',strtotime($input['start_date'])),
                                    'end_date'=>date('Y-m-d',strtotime($input['end_date'])),
                                    'amount'=>floatval($listing->price) * intval($num_of_days),
                                    'status'=>'pending'
                                );
                                Msg_requests_model::create($request_Data);
                                create_notification(array(
                                    'mem_id'=>$listing->mem_id,
                                    'text'=>$member->mem_fullname." has sent you a booking request for <strong>".$listing->title.". To view details, <a href='".config('app.react_url')."/dashboard/inbox/".doEncode($c_id)."'>Click Here</a></strong>",
                                    'status'=>0,
                                    'sender'=>$member->id,
                                ));
                                $res['status']=1;
                                $res['msg']='Message sent successfully!';
                            }
                            else{
                                $res['msg']='Technical problem!';
                            }
                        }
                    }
                }
                else{
                    $res['msg']='Invalid listing!';
                }
            }
        }
        exit(json_encode($res));
    }
    
}