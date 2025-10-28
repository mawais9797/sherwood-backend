<?php

namespace App\Http\Controllers;

use App\Models\Member_model;
use App\Models\Member_questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class Account extends Controller
{
    
    public function resend_email(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $memberRow=Member_model::where(['id' => $member->id])->get()->first();
            $otp=random_int(100000, 999999);
            $memberRow->otp=$otp;
            $memberRow->update();
            $token=$memberRow->id."-".$memberRow->mem_email."-".$memberRow->mem_type."-".rand(99,999);
            $userToken=encrypt_string($token);
            $token_array=array(
                'mem_type'=>$memberRow->mem_type,
                'token'=>$userToken,
                'mem_id'=>$memberRow->id,
                'expiry_date'=>date("Y-m-d", strtotime("6 months")),
            );
            DB::table('tokens')->insert($token_array);
            $email_data=array(
                'email_to'=>$memberRow->mem_email,
                'email_to_name'=>$memberRow->mem_fname,
                'email_from'=>'noreply@liveloftus.com',
                'email_from_name'=>$this->data['site_settings']->site_name,
                'subject'=>'Email Verification',
                'link'=>config('app.react_url')."/verification/".$userToken,
                // 'code'=>$data['otp'],
            );
            $email=send_email($email_data,'account');
            if($email){
                $res['msg']="Verification email has been sent with verification link to your email.";
                $res['status']=1;
            }
            else{
                $res['msg']="Email could not be sent!";
            }

        }
        else{
            $res['member']=null;
        }

        exit(json_encode($res));
    }
    
    public function update_password(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $member=Member_model::where(['id' => $member->id])->get()->first();
            $input = $request->all();
            $request_data = [
                'old_password'     => 'required',
                'new_password'     => 'required',
                'confirm_password' => 'required|same:new_password',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                $memberRow=Member_model::where(['mem_password'=>md5($input['old_password'])])->get()->first();
                if(!empty($memberRow)){
                    $member->mem_password=md5($input['new_password']);
                    $member->update();
                    $res['msg']="Password updated successfully!";
                    $res['status']=1;
                }
                else{
                    $res['msg']='Old password does not match';
                }
            }
        }
        else{
            $res['member']=null;
        }

        exit(json_encode($res));
    }
    public function deactivate_account(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $member=Member_model::where(['id' => $member->id])->get()->first();
            $input = $request->all();
            $request_data = [
                'reason'     => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors()->first();
            }
            else{
                    $member->is_deactivated=1;
                    $member->deactivated_reason=$input['reason'];
                    $member->update();
                    $res['msg']="Account Deactivated successfully!";
                    $res['status']=1;
            }
        }
        else{
            $res['member']=null;
        }

        exit(json_encode($res));
    }
    public function update_profile(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $member=Member_model::where(['id' => $member->id])->get()->first();
            $input = $request->all();
            // $res['input']=date('d-m-Y',strtotime(json_decode($input['dob'])));
             // exit(json_encode($res));
            $member->mem_display_name=$input['display_name'];
            $member->mem_fullname=$input['name'];
            $member->mem_bio=$input['bio'];
            $member->mem_address1=!empty($input['address']) ? $input['address'] : '';
            $member->mem_phone=$input['phone'];
            $member->update();
            $res['msg']="Profile updated successfully!";
            $res['status']=1;
            // $res['dob']= date('d-m-Y',strtotime(json_decode($input['dob'])));
        }
        else{
            $res['member']=null;
        }

        exit(json_encode($res));
    }
    public function notifications(Request $request){
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $notifications=DB::table('notifications')->where(['mem_id'=> $member->id,'status'=>0])->get();
            if($notifications->count() > 0){
                foreach($notifications as $notify){
                    DB::table('notifications')->where('id', $notify->id)->update(array('status' => 1));
                }
            }
            $this->data['notifications']=get_notifications($member->id);
            $this->data['page_title']='Notifications';
        }
        exit(json_encode($this->data));
    }
    public function delete_notification(Request $request,$id){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){ 
            
            if(intval($id)> 0 && $notification=DB::table('notifications')->where(['mem_id'=> $member->id,'id'=>$id])->get()->first()){
                DB::table('notifications')->where('id', $id)->delete();
                $res['status']=1;
                $res['msg']='Notification deleted successfully!';
            }
            else{
                $res['msg']='Notification does not found!';
            }
        }
        exit(json_encode($res));
    }
    


}