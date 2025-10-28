<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Conversations_model;
use App\Models\Msgs_model;
use App\Models\Member_model;
use App\Models\Msg_requests_model;
use App\Models\Booking_model;
use App\Models\Listings_model;
use App\Models\Booking_transactions_model;
use App\Models\Booking_log_model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class Chat extends Controller
{
    public function confirm_buyer_request(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $request_data = [
                'type' => 'required',
                'request_id' => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                $memberId=$member->id;
                $requestId=doDecode($input['request_id']);
                if(intval($requestId) > 0 && $request_row = Msg_requests_model::select('msg_requests.*','conversations.id as conversation_id')
                ->join('msgs', 'msg_requests.msg_id', '=', 'msgs.id')
                ->join('conversations', 'msgs.c_id', '=', 'conversations.id')
                ->join('members', function ($join) use ($memberId) {
                    $join->on('conversations.sender', '=', 'members.id')
                         ->orOn('conversations.receiver', '=', 'members.id');
                })
                ->where('msg_requests.id', $requestId)
                ->where(function ($query) use ($memberId) {
                    $query->where('conversations.sender', $memberId)
                          ->orWhere('conversations.receiver', $memberId);
                })
                ->first()){
                    if($request_row->listing_row){
                        $listing_row=$request_row->listing_row;
                        $msg_row=$request_row->msg_row;
                        if($message_by_row=$request_row->msg_row->message_by_row){
                            Msg_requests_model::where(['id'=>$request_row->id])->update(array(
                                'status'=>$input['type']
                            ));
                            create_notification(array(
                                'mem_id'=>$message_by_row->id,
                                'text'=>$member->mem_fullname." has confirmed your request for <strong>".$listing_row->title."</strong>. To view details, <a href='".config('app.react_url')."/dashboard/inbox/".doEncode($request_row->msg_row->c_id)."'>Click Here</a>",
                                'status'=>0,
                                'sender'=>$member->id,
                            ));
                            $conversation_information=$this->get_chat_messages($request_row->conversation_id,$member);
                            $res['chat_msgs']=$conversation_information['msgs'];
                            $res['status']=1;
                            $res['msg']='Request has been '.$input['type'];
                        }
                        else{
                            $res['msg']='Invalid requested user!';
                        }
                    }
                    else{
                        $res['msg']='Invalid request listing!'; 
                    }
                }
                else{
                    $res['msg']='Invalid request!';
                }
            }
        }
        exit(json_encode($res));
    }
    public function booking_extension_details(Request $request,$id){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $this->data['status']=0;
        if(!empty($member)){
            $extension_id=doDecode($id);
            if(intval($extension_id) > 0 && $request_sub_row=Msg_requests_model::where('id',$extension_id)->where('parent_id','!=',0)->get()->first()){
                if($request_row=$request_sub_row->request_parent_row){
                    if($listing_row=$request_row->listing_row){
                        if($booking_row=$request_sub_row->request_parent_row->booking_row){
                            $requestObj=(Object)[];
                                // $requestObj->id=$request_row->id;
                                $requestObj->id=($request_sub_row->id);
                                $requestObj->booking_encoded_id=doEncode($request_row->booking_row->id);
                                $requestObj->extension_encoded_id=doEncode($request_sub_row->id);
                                $requestObj->listing_id=$request_row->listing_row->id;
                                $requestObj->listing_title=$request_row->listing_row->title;
                                $requestObj->listing_address=$request_row->listing_row->address;
                                $requestObj->start_date=format_date($request_sub_row->start_date,'d M');
                                $requestObj->end_date=format_date($request_sub_row->end_date,'d M');
                                $requestObj->listing_total_days=calculateDaysBetween($request_sub_row->start_date,$request_sub_row->end_date);
                                $requestObj->listing_thumb=get_site_image_src('listings',!empty($request_row->listing_row->singleFirstImage) ? $request_row->listing_row->singleFirstImage->image : "");
                                $requestObj->listing_amount=$request_sub_row->amount;
                                $requestObj->service_fee=$this->data['site_settings']->site_processing_fee;
                                $requestObj->listing_duration=format_date($request_sub_row->start_date,'d M')." - ".format_date($request_sub_row->end_date,'d M');
                                $requestObj->status=$request_sub_row->status;
                                if($request_row->listing_row->mem_id==$member->id){
                                    $requestObj->is_seller='yes';
                                }
                                else{
                                    $requestObj->listing_owner_thumb=get_site_image_src('members',!empty($request_row->listing_row->member_row) ? $request_row->listing_row->member_row->mem_image : "");
                                    $requestObj->listing_owner_name=$request_row->listing_row->member_row->mem_fullname;
                                    $requestObj->listing_owner_address=$request_row->listing_row->member_row->mem_address1;
                                }
                                $this->data['requestObj']=$requestObj;
                        }
                    }
                }
            }
        }
        exit(json_encode($this->data));
    }
    public function booking_extension_request(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $request_data = [
                'type' => 'required',
                'extension_encoded_id' => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                $memberId=$member->id;
                $extension_id=doDecode($input['extension_encoded_id']);
                if(intval($extension_id) > 0 && $extension_request=Msg_requests_model::where('id',$extension_id)->where('parent_id','!=',0)->get()->first()){
                    if($request_row=$extension_request->request_parent_row){
                        if($request_row->msg_row->sender!=$member->id){
                            $member_id=$request_row->msg_row->sender;
                        }
                        else{
                            $member_id=$request_row->msg_row->receiver;
                        }
                        $listing_row=$request_row->listing_row;
                        if($booking_row=$extension_request->request_parent_row->booking_row){
                            Msg_requests_model::where('id',$extension_request->id)->update(array(
                                'status'=>$input['type']
                            ));
                            Booking_log_model::create(array(
                                'booking_id'=>$booking_row->id,
                                'text'=>'Booking extension request was '.$input['type'].' on '.date('Y-m-d')
                            ));
                            create_notification(array(
                                'mem_id'=>$member_id,
                                'text'=>$member->mem_fullname." has confirmed your extension request for <strong>".$listing_row->title."</strong>. To view details, <a href='".config('app.react_url')."/dashboard/inbox/".doEncode($request_row->msg_row->c_id)."'>Click Here</a>",
                                'status'=>0,
                                'sender'=>$member->id,
                            ));
                            $conversation_information=$this->get_chat_messages($request_row->msg_row->c_id,$member);
                            $res['chat_msgs']=$conversation_information['msgs'];
                            $res['status']=1;
                            $res['msg']='Request has been '.$input['type'];
                        }
                        else{
                            $res['msg']='Invalid rental booking!';
                        }
                    }
                    else{
                        $res['msg']='Invalid rental request!';
                    }
                }
                else{
                    $res['msg']='Invalid extension request!';
                }
            }
        }
        else{
            $res['msg']='Invalid user!';
        }
        exit(json_encode($res));
    }
    private function get_chat_messages($conversation_id,$member){
        $this->data['chat_msgs']=array();
        $this->data['user_info']=(Object)[];
        if(!empty($conversation_id)){
            
            $conversation_row=Conversations_model::where(['conversations.id'=>intval($conversation_id),'conversations.status'=>'open'])->where(function ($query) use ($member) {
                        $query->where('conversations.sender', $member->id)
                              ->orWhere('conversations.receiver', $member->id);
                    })->get()->first();
            if(!empty($conversation_row)){ 
                if($member->id!=$conversation_row->sender){
                    $user_info=(Object)[];
                    if($conversation_row->sender_row){
                        $user_info->name= $conversation_row->sender_row->mem_fullname;
                        $user_info->thumb= get_site_image_src('members', $conversation_row->sender_row->mem_image);
                    }
                    $this->data['user_info']=$user_info;
                }
                if($member->id!=$conversation_row->receiver){
                    $user_info=(Object)[];
                    if($conversation_row->receiver_row){
                        $user_info->name= $conversation_row->receiver_row->mem_fullname;
                        $user_info->thumb= get_site_image_src('members', $conversation_row->receiver_row->mem_image);
                    }
                    $this->data['user_info']=$user_info;
                }     
                $msgs=$conversation_row->msgs;
                foreach($msgs as $msg){
                    $msgObj=(Object)[];
                    $msgObj->id=$msg->id;
                    $msgObj->encoded_id=doEncode($msg->id);
                    $msgObj->msg=$msg->msg;
                    $msgObj->time=format_date($msg->created_at,'M d, Y H:i a');
                    if($msg->message_by==$member->id){
                        $msgObj->msg_type='me';
                    }
                    else{
                        $msgObj->msg_type='you';
                    }
                    if($msg->message_by==$msg->sender){
                        if(!empty($msg->sender_row)){
                            $msgObj->user_name=$msg->sender_row->mem_fullname;
                            $msgObj->user_thumb=get_site_image_src('members', !empty($msg->sender_row) ? $msg->sender_row->mem_image  : '');
                        }
                    }
                    else if($msg->message_by==$msg->receiver){
                        if(!empty($msg->receiver_row)){
                            $msgObj->user_name=$msg->receiver_row->mem_fullname;
                            $msgObj->user_thumb=get_site_image_src('members', !empty($msg->receiver_row) ? $msg->receiver_row->mem_image  : '');
                        }
                    }
                    $msgObj->type=$msg->type;
                    if($msg->type=='request'){
                        if($request_row=$msg->request_row){
                            $requestObj=(Object)[];
                            $requestObj->id=$msg->request_row->id;
                            $requestObj->encoded_id=doEncode($msg->request_row->id);
                            $requestObj->listing_id=$msg->request_row->listing_row->id;
                            $requestObj->listing_title=$msg->request_row->listing_row->title;
                            $requestObj->listing_start_date=format_date($msg->request_row->start_date,'d M');
                            $requestObj->listing_end_date=format_date($msg->request_row->end_date,'d M');
                            $requestObj->listing_total_days=calculateDaysBetween($msg->request_row->start_date,$msg->request_row->end_date);
                            $requestObj->listing_thumb=get_site_image_src('listings',!empty($msg->request_row->listing_row->singleFirstImage) ? $msg->request_row->listing_row->singleFirstImage->image : "");
                            $requestObj->listing_amount=$msg->request_row->amount;
                            $requestObj->service_fee=$this->data['site_settings']->site_processing_fee;
                            $requestObj->listing_duration=format_date($msg->request_row->start_date,'d M')." - ".format_date($msg->request_row->end_date,'d M');
                            $requestObj->status=$msg->request_row->status;
                            if($msg->request_row->listing_row->mem_id==$member->id){
                                $requestObj->is_seller='yes';
                            }
                            else{
                                $requestObj->listing_owner_thumb=get_site_image_src('members',!empty($msg->request_row->listing_row->member_row) ? $msg->request_row->listing_row->member_row->mem_image : "");
                                $requestObj->listing_owner_name=$msg->request_row->listing_row->member_row->mem_fullname;
                                $requestObj->listing_owner_address=$msg->request_row->listing_row->member_row->mem_address1;
                            }
                            $msgObj->request=$requestObj;
                        }
                    }
                    else if($msg->type=='extension'){
                        if($request_sub_row=$msg->request_extension_row){
                            if($request_row=$request_sub_row->request_parent_row){
                                $requestObj=(Object)[];
                                // $requestObj->id=$request_row->id;
                                $requestObj->booking_encoded_id=doEncode($request_row->booking_row->id);
                                $requestObj->extension_encoded_id=doEncode($request_sub_row->id);
                                $requestObj->listing_id=$request_row->listing_row->id;
                                $requestObj->listing_title=$request_row->listing_row->title;
                                $requestObj->listing_start_date=format_date($request_sub_row->start_date,'d M');
                                $requestObj->listing_end_date=format_date($request_sub_row->end_date,'d M');
                                $requestObj->listing_total_days=calculateDaysBetween($request_sub_row->start_date,$request_sub_row->end_date);
                                $requestObj->listing_thumb=get_site_image_src('listings',!empty($request_row->listing_row->singleFirstImage) ? $request_row->listing_row->singleFirstImage->image : "");
                                $requestObj->listing_amount=$request_sub_row->amount;
                                $requestObj->service_fee=$this->data['site_settings']->site_processing_fee;
                                $requestObj->listing_duration=format_date($request_sub_row->start_date,'d M')." - ".format_date($request_sub_row->end_date,'d M');
                                $requestObj->status=$request_sub_row->status;
                                if($request_row->listing_row->mem_id==$member->id){
                                    $requestObj->is_seller='yes';
                                }
                                else{
                                    $requestObj->listing_owner_thumb=get_site_image_src('members',!empty($request_row->listing_row->member_row) ? $request_row->listing_row->member_row->mem_image : "");
                                    $requestObj->listing_owner_name=$request_row->listing_row->member_row->mem_fullname;
                                    $requestObj->listing_owner_address=$request_row->listing_row->member_row->mem_address1;
                                }
                                $msgObj->request=$requestObj;
                                // pr($msgObj);
                            }
                        }
                    }
                    $this->data['chat_msgs'][]=$msgObj;
                }
            }
        }
        return array(
            'msgs'=>$this->data['chat_msgs'],
            'user_info'=>$this->data['user_info'],
        );
    }
    public function get_rental_request(Request $request,$id){
        $this->data['status']=0;
        $this->data['request_row']=null;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
         if($member){
            
            $this->data['member']=$member;
            $requestId=doDecode($id);
            $memberId=$member->id;
            if(intval($requestId) > 0 && $request_row = Msg_requests_model::select('msg_requests.*','conversations.id as conversation_id')
            ->join('msgs', 'msg_requests.msg_id', '=', 'msgs.id')
            ->join('conversations', 'msgs.c_id', '=', 'conversations.id')
            ->join('members', function ($join) use ($memberId) {
                $join->on('conversations.sender', '=', 'members.id')
                     ->orOn('conversations.receiver', '=', 'members.id');
            })
            ->where('msg_requests.id', $requestId)
            ->where('msg_requests.status', 'confirmed')
            ->where(function ($query) use ($memberId) {
                $query->where('conversations.sender', $memberId)
                      ->orWhere('conversations.receiver', $memberId);
            })
            ->first()){
                if($request_row->msg_row->message_by==$member->id){
                    if($request_row->listing_row){
                        $request_row->listing_row=$request_row->listing_row;
                        $request_row->encoded_id=doEncode($request_row->id);
                        $request_row->listing_id=$request_row->listing_row->id;
                        $request_row->listing_title=$request_row->listing_row->title;
                        $request_row->listing_start_date=format_date($request_row->start_date,'d M');
                        $request_row->listing_end_date=format_date($request_row->end_date,'d M');
                        $request_row->listing_total_days=calculateDaysBetween($request_row->start_date,$request_row->end_date);
                        $request_row->listing_thumb=get_site_image_src('listings',!empty($request_row->listing_row->singleFirstImage) ? $request_row->listing_row->singleFirstImage->image : "");
                        $request_row->listing_amount=$request_row->amount;
                        $request_row->service_fee=$this->data['site_settings']->site_processing_fee;

                        $percentAmount=calculatePercentage(floatval($request_row->amount),floatval($this->data['site_settings']->site_processing_fee));
                        $request_row->total_amount=floatval($request_row->amount)+floatval($percentAmount);

                        $request_row->listing_duration=format_date($request_row->start_date,'d M')." - ".format_date($request_row->end_date,'d M');
                        $request_row->status=$request_row->status;
                        $request_row->listing_owner_thumb=get_site_image_src('members',!empty($request_row->listing_row->member_row) ? $request_row->listing_row->member_row->mem_image : "");
                        $request_row->listing_owner_name=$request_row->listing_row->member_row->mem_fullname;
                        $request_row->listing_owner_address=$request_row->listing_row->member_row->mem_address1;
                        $this->data['request_row']=$request_row;
                        $this->data['countries']=get_countries(array());
                    }
                }
            }
         }
         exit(json_encode($this->data));
    }
    public function get_conversations(Request $request,$conversation_id){
        $this->data['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        // pr($member);
         if($member){
            $input = $request->all();
            if($input){
                $this->data['status']=1;
                $users=array();
                $users_arr=Conversations_model::where(['conversations.sender'=>$member->id,'conversations.status'=>'open'])->orWhere(['conversations.receiver'=>$member->id])->leftJoin('msgs', 'msgs.c_id', '=', 'conversations.id')->orderBy('conversations.created_at', 'desc')->groupBy('conversations.id')->get(['conversations.*','msgs.msg as msg','msgs.created_at as msg_created_date']);
                foreach($users_arr as $user_row){
                    $last_msg=Msgs_model::where(['c_id'=>$user_row->id])->orderBy('created_at', 'desc')->get()->first();
                    $user=(Object)[];
                    $user->id=$user_row->id;
                    $user->chat_id=doEncode($user_row->id);
                    $user->msg=$user_row->msg;
                    if($user_row->sender!=$member->id){
                        $sender=Member_model::where(['id'=>$user_row->sender])->get()->first();
                        $user->user_name=!empty($sender) ? $sender->mem_fullname : "";
                        $user->user_dp=get_site_image_src('members', !empty($sender) ? $sender->mem_image  : '');
                    }
                    if($user_row->receiver!=$member->id){
                        $receiver=Member_model::where(['id'=>$user_row->receiver])->get()->first();
                        $user->user_name=!empty($receiver) ? $receiver->mem_fullname : "";
                        $user->user_dp=get_site_image_src('members', !empty($receiver) ? $receiver->mem_image  : '');
                    }
                    $user->time=format_date($user_row->created_at,'M d');
                    if(!empty($last_msg)){
                        $user->msg=$last_msg->msg;
                    }
                    $users[]=$user;
                }
                $this->data['users']=$users;
                $this->data['member']=$member;
                if(!empty($conversation_id)){
                    $conversation_id=doDecode($conversation_id);
                    $conversation_information=$this->get_chat_messages($conversation_id,$member);
                    $this->data['chat_msgs']=$conversation_information['msgs'];
                    $this->data['user_info']=$conversation_information['user_info'];
                }  
            }
            else{
                $this->data['msg']='No data to post!';
            }
         }
         else{
            $this->data['msg']='Please login to continue!';
         }
         exit(json_encode($this->data));
    }
    public function request_extension(Request $request,$id){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $id=doDecode($id);
            if(intval($id) > 0 && $booking_row=Booking_model::where('id',intval($id))->get()->first()){
                $request_data = [
                    'days' => 'required',
                ];
                $validator = Validator::make($input, $request_data);
                if ($validator->fails()) {
                    $res['status']=0;
                    $res['msg']='Error >>'.$validator->errors()->first();
                }
                else{
                    if($booking_row->msgRequest){
                        if($booking_row->msgRequest->listing){
                            
                            $extension_date=addDaysToDate($booking_row->msgRequest->end_date,$input['days']);
                            if(isTwoDaysAfter($booking_row->msgRequest->end_date,date('Y-m-d')) < 2){
                                $res['msg']='Extension is only possible if the return date is exactly two days or more after the current date.';
                                exit(json_encode($res));
                            }
                            
                            $c_id=$booking_row->msgRequest->msg_row->c_id;
                            $listing=$booking_row->msgRequest->listing;
                            $listing_member=$listing->member_row;
                            $m_msg=array(
                                'c_id'=>$c_id,
                                'sender'=>$member->id,
                                'receiver'=>$listing_member->id,
                                'msg'=>"",
                                'message_by'=>$member->id,
                                'status'=>'sent',
                                'type'=>'extension',
                                'created_at'=>date("Y-m-d H:i:s")
                            );
                            // pr($m_msg);
                            $message_id=Msgs_model::create($m_msg);
                            $msg_id=$message_id->id;
                            if($msg_id > 0){
                                $request_Data=array(
                                    'msg_id'=>$msg_id,
                                    'listing_id'=>$listing->id,
                                    'start_date'=>addDaysToDate($booking_row->msgRequest->end_date,1),
                                    'end_date'=>$extension_date,
                                    'amount'=>floatval($listing->price) * intval($input['days']),
                                    'status'=>'pending',
                                    'parent_id'=>$booking_row->msgRequest->id
                                );
                                Msg_requests_model::create($request_Data);
                                Booking_log_model::create(array(
                                    'booking_id'=>$booking_row->id,
                                    'text'=>'Booking extension request was generated on '.date('Y-m-d')." from ".format_date($booking_row->msgRequest->end_date,'M d,Y')." to ".format_date($extension_date,'M d, Y')
                                ));
                                create_notification(array(
                                    'mem_id'=>$listing->mem_id,
                                    'text'=>$member->mem_fullname." has sent you extension request for <strong>".$listing->title."</strong>. To view details, <a href='".config('app.react_url')."/dashboard/inbox/".doEncode($c_id)."'>Click Here</a>",
                                    'status'=>0,
                                    'sender'=>$member->id,
                                ));
                                $res['status']=1;
                                $res['msg']='Request sent successfully!';
                            }
                        }
                        else{
                            $res['msg']='Invalid listing!';
                        }
                        
                    }
                    else{
                        $res['msg']='Invalid request!';
                    }
                   
                }
            }
            else{
                $res['msg']='Invalid booking!';
            }
        }
        else{
            $res['msg']='Invalid user!';
        }
        exit(json_encode($res));
    }
    public function extend_booking(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            // pr($input);
            if($input['payment_method']=='credit-card'):
                $request_data = [
                    'payment_method' => 'required',
                    'payment_method_id' => 'required',
                    'payment_intent' => 'required',
                    'customer_id' => 'required',
                    'extension_id' => 'required',
                ];
            else:
                $request_data = [
                    'payment_method' => 'required',
                    'payer_id' => 'required',
                    'order_id' => 'required',
                    'extension_id' => 'required',
                ];
            endif;
            $validator = Validator::make($input, $request_data);
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                if(intval($input['extension_id']) > 0 && $request_sub_row=Msg_requests_model::where('id',$input['extension_id'])->where('parent_id','!=',0)->get()->first()){
                    if($request_row=$request_sub_row->request_parent_row){
                        if($listing_row=$request_row->listing_row){
                            if($booking_row=$request_sub_row->request_parent_row->booking_row){
                                Msg_requests_model::where('id',$request_row->id)->update(array(
                                    'end_date'=>date('Y-m-d',strtotime($request_sub_row->end_date))
                                ));
                                Msg_requests_model::where('id',$request_sub_row->id)->update(array(
                                    'status'=>'booked'
                                ));
                                if($input['payment_method']=='credit-card'):
                                    $data=array(
                                        'payment_method'=>$input['payment_method'],
                                        'payment_method_id'=>$input['payment_method_id'],
                                        'payment_intent'=>$input['payment_intent'],
                                        'customer_id'=>$input['customer_id'],
                                        'booking_id'=>$booking_row->id,
                                        'status'=>'paid'
                                    );
                                else:
                                    $data=array(
                                        'payment_method'=>$input['payment_method'],
                                        'payer_id'=>$input['payer_id'],
                                        'order_id'=>$input['order_id'],
                                        'booking_id'=>$booking_row->id,
                                        'status'=>'paid'
                                    );
                                endif;
                                Booking_transactions_model::create($data);
                                Booking_log_model::create(array(
                                    'booking_id'=>$booking_row->id,
                                    'text'=>'Booking is extended on '.date('Y-m-d')." from ".format_date($request_row->end_date,'M d,Y')." to ".format_date($request_sub_row->end_date,'M d, Y')
                                ));
                                $res['status']=1;
                                $res['msg']='Extension paid successfully!';
                            }
                            else{
                                $res['msg']='Invalid booking';
                            }
                        }
                        else{
                            $res['msg']='Invalid listing!';
                        }
                    }
                    else{
                        $res['msg']='Invalid request!';
                    }
                }
                else{
                    $res['msg']='Invalid extension request!';
                }
            }
        }
        else{
            $res['msg']='Invalid user!';
        }
        exit(json_encode($res));
    }
    public function save_booking(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            if($input['payment_method']=='credit-card'):
                $request_data = [
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'state_id' => 'required',
                    'country_id' => 'required',
                    'zipcode' => 'required',
                    'payment_method' => 'required',
                    'payment_method_id' => 'required',
                    'payment_intent' => 'required',
                    'customer_id' => 'required',
                ];
            else:
                $request_data = [
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'state_id' => 'required',
                    'country_id' => 'required',
                    'zipcode' => 'required',
                    'payment_method' => 'required',
                    'payer_id' => 'required',
                    'order_id' => 'required',
                ];
            endif;
            $validator = Validator::make($input, $request_data);
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                if(intval($input['request_id']) > 0 && $request_row=Msg_requests_model::where('id',intval($input['request_id']))->get()->first()){
                    if($input['payment_method']=='credit-card'):
                        $data=array(
                            'fname'=>$input['fname'],
                            'lname'=>$input['lname'],
                            'email'=>$input['email'],
                            'phone'=>$input['phone'],
                            'address'=>$input['address'],
                            'city'=>$input['city'],
                            'state_id'=>$input['state_id'],
                            'country_id'=>$input['country_id'],
                            'zipcode'=>$input['zipcode'],
                            'payment_method'=>$input['payment_method'],
                            'payment_method_id'=>$input['payment_method_id'],
                            'payment_intent'=>$input['payment_intent'],
                            'customer_id'=>$input['customer_id'],
                            'request_id'=>$request_row->id,
                            'status'=>'paid'
                        );
                    else:
                        $data=array(
                            'fname'=>$input['fname'],
                            'lname'=>$input['lname'],
                            'email'=>$input['email'],
                            'phone'=>$input['phone'],
                            'address'=>$input['address'],
                            'city'=>$input['city'],
                            'state_id'=>$input['state_id'],
                            'country_id'=>$input['country_id'],
                            'zipcode'=>$input['zipcode'],
                            'payment_method'=>$input['payment_method'],
                            'payer_id'=>$input['payer_id'],
                            'paymentorder_id_intent'=>$input['order_id'],
                            'request_id'=>$request_row->id,
                            'status'=>'paid'
                        );
                    endif;
                    $id=Booking_model::create($data);
                    $booking_id=$id->id;
                    if($booking_id > 0){
                        create_notification(array(
                            'mem_id'=>$request_row->listing_row->mem_id,
                            'text'=>$member->mem_fullname." has paid for <strong>".$request_row->listing_row->title."</strong>. To view details, <a href='".config('app.react_url')."/dashboard/bookings/'>Click Here</a>",
                            'status'=>0,
                            'sender'=>$member->id,
                        ));
                        Msg_requests_model::where(['id'=>$request_row->id])->update(array('status'=>'booked'));
                        $res['msg']='Successfully Booked!';
                        $res['status']=1;
                    }
                }
                else{
                    $res['msg']='Invalid request!';
                }
            }
        }
        else{
            $res['msg']='Invalid user!';
        }
        exit(json_encode($res));
    }
    public function create_payment_intent(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $request_data = [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state_id' => 'required',
                'country_id' => 'required',
                'zipcode' => 'required',
                'payment_method' => 'required',
                'payment_method_id' => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                if(intval($input['request_id']) > 0 && $request_row=Msg_requests_model::where('id',intval($input['request_id']))->get()->first()){
                    $stripe = new StripeClient(
                        intval($this->data['site_settings']->site_sandbox) ==0 ? env('STRIPE_LIVE_SECRET_KEY') : env('STRIPE_TESTING_SECRET_KEY')
                    );
                    try{
                        $percentAmount=calculatePercentage(floatval($request_row->amount),floatval($this->data['site_settings']->site_processing_fee));
                        $amount=floatval($request_row->amount)+floatval($percentAmount);
                        $cents = intval($amount * 100);
                        if(!empty($member->customer_id)){
                            $customer_id=$member->customer_id;
                        }
                        else{
                            $customer = $stripe->customers->create([
                                'email' =>$input['email'],
                                'name' =>$input['fname']." ".$input['lname'],
                                // 'address' => $stripe_adddress,
                            ]);
                            $customer_id=$customer->id;
                        }
                        $intent= $stripe->paymentIntents->create([
                            'amount' => $cents,
                            'currency' => 'usd',
                            'customer'=>$customer_id,
                            // 'payment_method' => $vals['payment_method'],
                            'setup_future_usage' => 'off_session',
                        ]);
                        $arr=array(
                            'paymentIntentId'=>$intent->id,
                            'client_secret'=>$intent->client_secret,
                            'customer'=>$customer_id,
                            'status'=>1
                        );
                        $res['arr']=$arr;
                        $res['status']=1;
                    }
                    catch(Exception $e) {
                        $arr['msg']="Error >> ".$e->getMessage();
                        $arr['status']=0;
                    }
                }
                else{
                    $res['msg']='Invalid request!';
                }
            }
        }
        else{
            $res['msg']='Invalid user!';
        }
        exit(json_encode($res));
    }
    public function create_extension_payment_intent(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $res=array();
        $res['status']=0;
        if(!empty($member)){
            $input = $request->all();
            $request_data = [
                'payment_method' => 'required',
                'payment_method_id' => 'required',
                'extension_id' => 'required',
                'days' => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                if(intval($input['extension_id']) > 0 && $request_sub_row=Msg_requests_model::where('id',$input['extension_id'])->where('parent_id','!=',0)->get()->first()){
                    if($request_row=$request_sub_row->request_parent_row){
                        if($listing_row=$request_row->listing_row){
                            if($booking_row=$request_sub_row->request_parent_row->booking_row){
                                $stripe = new StripeClient(
                                    intval($this->data['site_settings']->site_sandbox) ==0 ? env('STRIPE_LIVE_SECRET_KEY') : env('STRIPE_TESTING_SECRET_KEY')
                                );
                                try{
                                    $listing_amount=$listing_row->price;
                                    $reqAmount=floatval($listing_amount) * intval($input['days']);
                                   
                                    $percentAmount=calculatePercentage(floatval($reqAmount),floatval($this->data['site_settings']->site_processing_fee));
                                    $amount=floatval($reqAmount)+floatval($percentAmount);
                                    $cents = intval($amount * 100);
                                    if(!empty($member->customer_id)){
                                        $customer_id=$member->customer_id;
                                    }
                                    else{
                                        $customer = $stripe->customers->create([
                                            'email' =>$member->mem_email,
                                            'name' =>$member->mem_fname." ".$member->mem_lname,
                                            // 'address' => $stripe_adddress,
                                        ]);
                                        $customer_id=$customer->id;
                                    }
                                    $intent= $stripe->paymentIntents->create([
                                        'amount' => $cents,
                                        'currency' => 'usd',
                                        'customer'=>$customer_id,
                                        // 'payment_method' => $vals['payment_method'],
                                        'setup_future_usage' => 'off_session',
                                    ]);
                                    $arr=array(
                                        'paymentIntentId'=>$intent->id,
                                        'client_secret'=>$intent->client_secret,
                                        'customer'=>$customer_id,
                                        'status'=>1
                                    );
                                    $res['arr']=$arr;
                                    $res['status']=1;
                                }
                                catch(Exception $e) {
                                    $arr['msg']="Error >> ".$e->getMessage();
                                    $arr['status']=0;
                                }
                            }
                        }
                    }
                }
                else{
                    $res['msg']='Invalid request!';
                }
            }
        }
        else{
            $res['msg']='Invalid user!';
        }
        exit(json_encode($res));
    }
    public function get_bookings(Request $request){
        $this->data['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if($member){
            $member_id=$member->id;
            $renter_bookings_arr = Booking_model::with(['msgRequest', 'msgRequest.listing','msgRequest.listing.firstListingImage','msgRequest.listing.member_row:id,mem_fullname'])->whereHas('msgRequest.msg', function($query) use ($member_id) {
                $query->where('message_by', $member_id);
            })->get();
            $owner_bookings_arr = Booking_model::with(['msgRequest','msgRequest.listing','msgRequest.listing.firstListingImage','msgRequest.msg.member:id,mem_fullname'])->whereHas('msgRequest.listing', function($query) use ($member_id) {
                $query->where('mem_id', $member_id);
            })->get();
            $renter_bookings=array();
            foreach($renter_bookings_arr as $renter_booking){
                $booking=(Object)[];
                $booking->id=$renter_booking->id;
                $booking->encoded_id=doEncode($renter_booking->id);
                $booking->status=$renter_booking->status;
                $booking->listing_title=$renter_booking->msgRequest->listing->title;
                
                $booking->listing_image=$renter_booking->msgRequest->listing->firstListingImage->image;
                $booking->member_name=$renter_booking->msgRequest->listing->member_row->mem_fullname;
                $booking->rent_amount=$renter_booking->msgRequest->amount;
                $booking->item_status=$renter_booking->msgRequest->status;
                $booking->duration=format_date($renter_booking->msgRequest->start_date,'d M')." - ".format_date($renter_booking->msgRequest->end_date,'d M');
                $booking->days=calculateDaysBetween($renter_booking->msgRequest->start_date,$renter_booking->msgRequest->end_date);
                $renter_bookings[]=$booking;
            }
            $owner_bookings=array();
            foreach($owner_bookings_arr as $owner_booking){
                $booking=(Object)[];
                $booking->id=$owner_booking->id;
                $booking->encoded_id=doEncode($owner_booking->id);
                $booking->status=$owner_booking->status;
                $booking->listing_title=$owner_booking->msgRequest->listing->title;
                
                $booking->listing_image=$owner_booking->msgRequest->listing->firstListingImage->image;
                $booking->member_name=$owner_booking->msgRequest->msg->member->mem_fullname;
                $booking->rent_amount=$owner_booking->msgRequest->amount;
                $booking->item_status=$owner_booking->msgRequest->status;
                $booking->duration=format_date($owner_booking->msgRequest->start_date,'d M')." - ".format_date($owner_booking->msgRequest->end_date,'d M');
                $booking->days=calculateDaysBetween($owner_booking->msgRequest->start_date,$owner_booking->msgRequest->end_date);
                $owner_bookings[]=$booking;
            }

            // $this->data['p_sql'] = Str::replaceArray('?', $renter_bookings->getBindings(), $renter_bookings->toSql());
            $this->data['renter_bookings']=$renter_bookings;
            $this->data['owner_bookings']=$owner_bookings;
        }
        exit(json_encode($this->data));
    }
    public function get_booking_details(Request $request,$id){
        $this->data['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if($member){
            $this->data['member']=$member;
            $this->data['countries']=get_countries(array());
            $member_id=$member->id;
            $type=$request->input('type', null);
            if($type=='owner'){
               $id=doDecode($id);
                if(intval($id) > 0 &&  $this->data['booking'] = Booking_model::with(['msgRequest','msgRequest.listing','msgRequest.listing.firstListingImage','msgRequest.msg.member:id,mem_fullname,mem_image,mem_address1'])->where('id',$id)->whereHas('msgRequest.listing', function($query) use ($member_id) {
                    $query->where('mem_id', $member_id);
                })->first()){
                    $this->data['booking']->booking_log=$this->data['booking']->booking_log;
                    $this->data['booking']->encoded_id=doEncode($this->data['booking']->id);
                    $this->data['booking']->status=$this->data['booking']->status;
                    $this->data['booking']->listing_title=$this->data['booking']->msgRequest->listing->title;
                    $this->data['booking']->listing_address=$this->data['booking']->msgRequest->listing->address;
                    
                    $this->data['booking']->listing_image=$this->data['booking']->msgRequest->listing->firstListingImage->image;
                    $this->data['booking']->member_name=$this->data['booking']->msgRequest->msg->member->mem_fullname;
                    $this->data['booking']->member_image=$this->data['booking']->msgRequest->msg->member->mem_image;
                    $this->data['booking']->member_address=$this->data['booking']->msgRequest->msg->member->mem_address1;
                    $this->data['booking']->rent_amount=$this->data['booking']->msgRequest->amount;
                    $this->data['booking']->service_fee=$this->data['site_settings']->site_processing_fee;
                    $percentAmount=calculatePercentage(floatval($this->data['booking']->msgRequest->amount),floatval($this->data['site_settings']->site_processing_fee));
                    $this->data['booking']->total_amount=floatval($this->data['booking']->msgRequest->amount)+floatval($percentAmount);
                    $this->data['booking']->item_status=$this->data['booking']->msgRequest->status;
                    $this->data['booking']->start_date=format_date($this->data['booking']->msgRequest->start_date,'F d M');
                    $this->data['booking']->end_date=format_date($this->data['booking']->msgRequest->end_date,'F d M');
                    $this->data['booking']->days=calculateDaysBetween($this->data['booking']->msgRequest->start_date,$this->data['booking']->msgRequest->end_date);
                }
            }
            else if($type=='buyer'){
                $id=doDecode($id);
                if(intval($id) > 0 &&  $this->data['booking'] = Booking_model::with(['msgRequest', 'msgRequest.listing','msgRequest.listing.firstListingImage','msgRequest.listing.member_row:id,mem_fullname,mem_image,mem_address1'])->where('id',$id)->whereHas('msgRequest.msg', function($query) use ($member_id) {
                    $query->where('message_by', $member_id);
                })->first()){
                    if($extension_request=Msg_requests_model::where('parent_id',$this->data['booking']->msgRequest->id)->where('status','pending')->orderBy('id', 'desc')->get()->first()){
                        $this->data['booking']->extension_request_generated=1;
                    }
                    if($extension_request=Msg_requests_model::where('parent_id',$this->data['booking']->msgRequest->id)->where('status','confirmed')->orderBy('id', 'desc')->get()->first()){
                        $this->data['booking']->extension_request_confirmed=1;
                        $this->data['booking']->extension_encoded_id=doEncode($extension_request->id);
                    }
                    $this->data['booking']->booking_log=$this->data['booking']->booking_log;
                    $this->data['booking']->encoded_id=doEncode($this->data['booking']->id);
                    $this->data['booking']->status=$this->data['booking']->status;
                    $this->data['booking']->id=$this->data['booking']->id;
                    $this->data['booking']->encoded_id=doEncode($this->data['booking']->id);
                    $this->data['booking']->status=$this->data['booking']->status;
                    $this->data['booking']->listing_title=$this->data['booking']->msgRequest->listing->title;
                    $this->data['booking']->listing_address=$this->data['booking']->msgRequest->listing->address;
                    $this->data['booking']->listing_amount=$this->data['booking']->msgRequest->listing->price;
                    
                    $this->data['booking']->listing_image=$this->data['booking']->msgRequest->listing->firstListingImage->image;
                    $this->data['booking']->member_name=$this->data['booking']->msgRequest->listing->member_row->mem_fullname;
                    $this->data['booking']->member_address=$this->data['booking']->msgRequest->listing->member_row->mem_address1;
                    $this->data['booking']->member_image=$this->data['booking']->msgRequest->listing->member_row->mem_image;
                    $this->data['booking']->rent_amount=$this->data['booking']->msgRequest->amount;
                    $this->data['booking']->item_status=$this->data['booking']->msgRequest->status;
                    $this->data['booking']->duration=format_date($this->data['booking']->msgRequest->start_date,'d M')." - ".format_date($this->data['booking']->msgRequest->end_date,'d M');
                    $this->data['booking']->start_date=format_date($this->data['booking']->msgRequest->start_date,'d M');
                    $this->data['booking']->end_date=format_date($this->data['booking']->msgRequest->end_date,'d M');
                    $this->data['booking']->end_date_with_year=format_date($this->data['booking']->msgRequest->end_date,'d M Y');
                    $this->data['booking']->picked_item_date_format=format_date($this->data['booking']->picked_item_date,'d M Y');
                    $this->data['booking']->returned_item_date_format=format_date($this->data['booking']->returned_item_date,'d M Y');
                    $this->data['booking']->end_date_in_date_format=date('Y-m-d',strtotime($this->data['booking']->msgRequest->end_date));
                    $this->data['booking']->rent_amount=$this->data['booking']->msgRequest->amount;
                    $this->data['booking']->service_fee=$this->data['site_settings']->site_processing_fee;

                    $percentAmount=calculatePercentage(floatval($this->data['booking']->msgRequest->amount),floatval($this->data['site_settings']->site_processing_fee));
                    $this->data['booking']->total_amount=floatval($this->data['booking']->msgRequest->amount)+floatval($percentAmount);
                    $this->data['booking']->days=calculateDaysBetween($this->data['booking']->msgRequest->start_date,$this->data['booking']->msgRequest->end_date);
                }
            }
        }
        exit(json_encode($this->data));
    }
    public function change_booking_status(Request $request,$id){
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if($member){
            $member_id=$member->id;
            $user_type=$request->input('user', null);
            $type=$request->input('type', null);
            $booking_status_type=$request->input('booking_status_type', null);
            $id=doDecode($id);
            if($user_type=='owner'){
                if(intval($id) > 0 &&  $booking = Booking_model::with(['msgRequest','msgRequest.listing','msgRequest.listing.firstListingImage','msgRequest.msg.member:id,mem_fullname,mem_image,mem_address1'])->where('id',$id)->whereHas('msgRequest.listing', function($query) use ($member_id) {
                    $query->where('mem_id', $member_id);
                })->first()){
                    if($booking_status_type=='picked'){
                        if($type=='yes'){
                            $picked_item_status=1;
                        }
                        else{
                            $picked_item_status=0;
                        }
                        Booking_model::where('id',$booking->id)->update(array('picked_item_status'=>$picked_item_status,'picked_item_date'=>date('Y-m-d')));
                        if($picked_item_status==1){
                            Booking_log_model::create(array(
                                'booking_id'=>$booking->id,
                                'text'=>'This item was picked on '.date('Y-m-d')
                            ));
                        }
                        $res['is_picked']=$picked_item_status;
                        $res['status']=1;
                    }
                    else if($booking_status_type=='returned'){
                        if($type=='yes'){
                            $return_item_status=1;
                        }
                        else{
                            $return_item_status=0;
                        }
                        Booking_model::where('id',$booking->id)->update(array('return_item_status'=>$return_item_status,'returned_item_date'=>date('Y-m-d')));
                        if($return_item_status==1){
                            Booking_log_model::create(array(
                                'booking_id'=>$booking->id,
                                'text'=>'This item was returned on '.date('Y-m-d')
                            ));
                        }
                        $res['is_picked']=$return_item_status;
                        $res['status']=1;
                    }
                    else{
                        $res['msg']='Invalid booking request!';
                    }
                }
                else{
                    $res['msg']='Invalid booking!';
                }
            }
            else if($user_type=='buyer'){
                if(intval($id) > 0 &&  $booking = Booking_model::with(['msgRequest', 'msgRequest.listing','msgRequest.listing.firstListingImage','msgRequest.listing.member_row:id,mem_fullname,mem_image,mem_address1'])->where('id',$id)->whereHas('msgRequest.msg', function($query) use ($member_id) {
                    $query->where('message_by', $member_id);
                })->first()){
                    if($booking_status_type=='picked'){
                        if($type=='yes'){
                            $picked_item_status=1;
                        }
                        else{
                            $picked_item_status=0;
                        }
                        Booking_model::where('id',$booking->id)->update(array('picked_item_status'=>$picked_item_status));
                        $res['is_picked']=$picked_item_status;
                        $res['status']=1;
                    }
                    else if($booking_status_type=='returned'){
                        if($type=='yes'){
                            $return_item_status=1;
                        }
                        else{
                            $return_item_status=0;
                        }
                        Booking_model::where('id',$booking->id)->update(array('return_item_status'=>$return_item_status));
                        $res['is_picked']=$return_item_status;
                        $res['status']=1;
                    }
                    else{
                        $res['msg']='Invalid booking request!';
                    }
                }
                else{
                    $res['msg']='Invalid booking!';
                }
            }
            else{
                $res['msg']='Invalid user request!';
            }
        }
        else{
            $res['msg']='invalid user!';
        }
        exit(json_encode($res));
    }
}