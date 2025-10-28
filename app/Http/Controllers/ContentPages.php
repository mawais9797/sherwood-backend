<?php

namespace App\Http\Controllers;

use App\Models\Impact_model;
use Illuminate\Support\Facades\DB;


use App\Models\Testimonial_model;

use App\Models\Projects_model;
use App\Models\Services_model;
use App\Models\Case_study_model;
use App\Models\Events_model;
use App\Models\Gallery_model;
use App\Models\Testimonials_Sherwood_model;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentPages extends Controller
{

    public function sherwood_home_page(Request $request){
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $res = [];
        // $res['content'] = get_page('home');
        $res['content'] = get_page('sherwoodhome'); //ckey sherwoodhome

        // pr($res['content']);
        $res['page_title'] = $res['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        // $res['cta_section'] = get_page('cta_section');
        $res['events'] = Events_model::orderBy('id', 'ASC')->get();

        $res['testimonials'] = Testimonials_Sherwood_model::orderBy('id', 'ASC')->get();

        $res['images'] = Gallery_model::orderBy('id', 'ASC')->get();



        $res['meta_desc'] = (object)[
            'meta_title' => $res['content']['meta_title'],
            'meta_description' => $res['content']['meta_description'],
            'meta_keywords' => $res['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $res['content']['meta_title'],
            'og_description' => $res['content']['meta_description'],
            'meta_keywords' => $res['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        exit(json_encode($res));
    }

    public function website_settings(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);

        $output['not_logged'] = false;
        $output['member'] = $member;
        if (empty($header) || $header == null || $header == 'null') {
            $output['not_logged'] = true;
        }
        // if (!empty($member) && $member != false) {
        //     $member->unread_notifications = DB::table('notifications')->where(['mem_id' => $member->id, 'status' => 0])->get()->count();
        //     $member->notifications = DB::table('notifications')->where(['mem_id' => $member->id])->orderBy('created_at', 'desc')->take(2)->get();
        //     $this->data['site_settings']->member = $member;
        // } else {
        //     $this->data['site_settings']->member = null;
        // }
        $output['site_settings'] = $this->data['site_settings'];
        exit(json_encode($output));
    }



    public function member_settings(Request $request)
    {
        $member_obj = (object)[];
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        if (!empty($member)) {
            $output['expire_time'] = format_date($member->otp_expire, 'Y-m-d H:i:s');
            $output['mem_image'] = $member->mem_image;
            $output['mem_name'] = $member->mem_fullname;
            $output['mem_email'] = $member->mem_email;
        }
        $output['member'] = $member;

        exit(json_encode($output));
    }

    public function header_services(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);

        $header_services = Services_model::where('status', '1')->orderBy('id', 'ASC')->get();

        $output['header_services'] = $header_services;

        return response()->json($output);
    }


    public function home_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('home');

        // pr($this->data['content']);
        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        // $this->data['cta_section'] = get_page('cta_section');
        $this->data['feat_projects'] = Projects_model::where('status', '1')
            ->where('featured', '1')
            ->orderBy('id', 'ASC')
            ->get();
        $this->data['feat_services'] = Services_model::where('status', '1')
            ->where('featured', '1')
            ->orderBy('id', 'ASC')
            ->get();



        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        exit(json_encode($this->data));
    }

    public function service_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('services');
        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;

        $this->data['services'] = Services_model::where('status', '1')->orderBy('id', 'ASC')->get();

        // $this->data['services'] = getMultiText('home-section5');
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        exit(json_encode($this->data));
    }



    public function serviceDetail_page(Request $request, $slug)
    {
        if (!empty($slug) && $this->data['services_detail'] = Services_model::orderBy('id', 'DESC')->where('status', 1)->where('slug', $slug)->get()->first()) {
            $this->data['content'] = get_page('services_detail');
            $this->data['page_title'] = $this->data['services_detail']->title;
            $service = $this->data['services_detail'];

            $service->servicesblock = DB::table('servicesblock')
                ->where('service_id', $service->id)
                ->orderBy('order_no')
                ->get();


            $this->data['feat_projects'] = Projects_model::where('status', '1')
                ->where('featured', '1')
                ->orderBy('id', 'ASC')
                ->get();

            $this->data['testimonials'] = Testimonial_model::where('status', 1)->get();
        }
        exit(json_encode($this->data));
    }



    public function project_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('projects');




        $this->data['feat_projects'] = Projects_model::with('category_row')
            ->where('status', '1')
            ->where('featured', '1')
            ->orderBy('id', 'ASC')
            ->get();


        $this->data['capabilities'] = getMultiText('project-section1');
        $this->data['technology'] = getMultiText('technology-section');
        $this->data['faq'] = getMultiText('faq-section');



        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        exit(json_encode($this->data));
    }


    public function projectDetail_page(Request $request, $slug)
    {
        if (!empty($slug) && $this->data['project_detail'] = Projects_model::orderBy('id', 'DESC')->where('status', 1)->where('slug', $slug)->get()->first()) {
            $this->data['content'] = get_page('project_detail');
            $this->data['page_title'] = $this->data['project_detail']->title;
            $this->data['project_detail']->cat_name = !empty($this->data['project_detail']->category_row) ? $this->data['project_detail']->category_row->name : '';
            $this->data['testimonials'] = Testimonial_model::where('status', 1)->get();
        }
        exit(json_encode($this->data));
    }

    public function caseStudy_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('caseStudy');
        $this->data['caseStud']=Case_study_model::select('id','title','short_desc','image','slug')->where('status',1)->get();
        $this->data['testimonials']=Testimonial_model::where('status',1)->get();
        $this->data['caseStudy_sec2'] = getMultiText('caseStudy-section2');
        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        exit(json_encode($this->data));
    }

    public function caseStudyDetail_page(Request $request,$slug)
    {

        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        // $this->data['content'] = get_page('caseStudyDetail'); caseStudyDetail-section1
        $this->data['caseStudyDetail_sec1'] = getMultiText('caseStudyDetail-section1');

        if (!empty($slug) && $this->data['caseStudy_detail'] =Case_study_model::orderBy('id', 'DESC')->where('status', 1)->where('slug', $slug)->get()->first()) {
            $this->data['content'] = get_page('caseStudyDetail');
            $this->data['page_title'] = $this->data['caseStudy_detail']->title;
             $this->data['caseStudy_detail']->cat_name = !empty($this->data['caseStudy_detail']->category_row) ? $this->data['caseStudy_detail']->category_row->name : '';
        }

        // $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        exit(json_encode($this->data));
    }

    public function impact_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('impact');

        $impacts = Impact_model::where('status', 1)->get();

        foreach ($impacts as $item) {
            $item->impactblocks = DB::table('impactblock')
                ->where('impact_id', $item->id)
                ->orderBy('order_no')
                ->get();
        }

        $this->data['impact'] = $impacts;

        $this->data['testimonials'] = Testimonial_model::where('status', 1)->get();

        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
        ];

        exit(json_encode($this->data));
    }



    public function about_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('about');
        $this->data['timeline'] = getMultiText('timeline-section');

        // $this->data['page_title'] = $this->data['content']['page_title'];
        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        exit(json_encode($this->data));
    }



    public function contact_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('contact');
        $this->data['page_title'] = $this->data['content']['page_title'];
        exit(json_encode($this->data));
    }


    public function terms_conditions_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('terms_conditions');
        $this->data['page_title'] = $this->data['content']['page_title'];
        exit(json_encode($this->data));
    }
    public function signup_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('signup');
        $this->data['page_title'] = $this->data['content']['page_title'];
        exit(json_encode($this->data));
    }
    public function login_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('login');
        $this->data['page_title'] = $this->data['content']['page_title'];
        exit(json_encode($this->data));
    }
    public function forgot_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('forgot');
        $this->data['page_title'] = $this->data['content']['page_title'];
        exit(json_encode($this->data));
    }
    public function reset_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('reset');
        $this->data['page_title'] = $this->data['content']['page_title'];
        exit(json_encode($this->data));
    }
}
