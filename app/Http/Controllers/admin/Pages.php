<?php

namespace App\Http\Controllers\admin;

use App\Models\Sitecontent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Pages extends Controller
{
    public function sherwood_home(Request $request)
    {
        // has_access(12);
       $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        // pr($request->all());
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = [];
            }
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 12; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);


                    }
                }
            }
            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_home_sherwood', $this->data);
    }

    public function home(Request $request)
    {
        // has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = [];
            }
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_home', $this->data);
    }
    public function serviceDetail(Request $request)
    {
        // has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = [];
            }
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }

            // pr($input);
            $sec5['title'] = $input['sec5_title'] ?? '';
            $sec5['txt1'] = $input['sec5_txt1'] ?? '';
            $sec5['order_no'] = $input['sec5_order_no'] ?? '';

            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_servicesDetail', $this->data);
    }

    public function services(Request $request)
    {
        // has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = [];
            }
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }

            // pr($input);
            $sec5['title'] = $input['sec5_title'] ?? '';
            $sec5['txt1'] = $input['sec5_txt1'] ?? '';
            $sec5['order_no'] = $input['sec5_order_no'] ?? '';

            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_services', $this->data);
    }

    public function projectDetail(Request $request)
    {
        // has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            // dd($input);
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = [];
            }
            if (!is_array($content_row)) {
                $content_row = [];
            }

            // pr($input);

            // pr($input);
            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_projectDetail', $this->data);
    }

    public function projects(Request $request)
    {
        // has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            // dd($input);
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = [];
            }
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }

            // dd($request->all());
             // row repeater
             $sec1['title'] = $input['sec1_title'] ?? '';
             $sec1['txt1'] = $input['sec1_txt1'] ?? '';
             $sec1['order_no'] = $input['sec1_order_no'] ?? '';
             $sec1Phto['pics'] = $input['sec1_pics'] ?? '';

             unset($input['sec1_pics'], $input['sec1_order_no'], $input['sec1_title'], $input['sec1_txt1']);
             DB::table('multi_text')->where('section', 'project-section1')->delete();
             $sec1s = ['order_no' => $sec1['order_no'], 'title' => $sec1['title'], 'txt1' => $sec1['txt1']];
             // pr($sec1Phto);
             if (!empty($request->file('sec1_image')) || !empty($sec1Phto['pics'])) {
                 saveMultiMediaFieldsImgs('public/images/', $request->file('sec1_image'), 'sec1_image', 'project-section1', $sec1Phto['pics'], $sec1s);
             }
             unset($input['sec1_image']);



            // pr($input);
            $sec2['title'] = $input['sec2_title'] ?? '';
            $sec2['txt1'] = $input['sec2_txt1'] ?? '';
            $sec2['order_no'] = $input['sec2_order_no'] ?? '';

            // $sec4Phto['pics'] = $input['sec4_pics'] ?? '';
            unset($input['sec2_order_no'], $input['sec2_title'], $input['sec2_txt1']);
            DB::table('multi_text')->where('section', 'technology-section')->delete();
            $sec1s = ['order_no' => $sec2['order_no'], 'title' => $sec2['title'], 'txt1' => $sec2['txt1']];
            saveMultiText($sec1s, 'technology-section');

            // Faq row repeater
              // pr($input);
              $sec3['title'] = $input['sec3_title'] ?? '';
              $sec3['txt1'] = $input['sec3_txt1'] ?? '';
              $sec3['order_no'] = $input['sec3_order_no'] ?? '';

              // $sec4Phto['pics'] = $input['sec4_pics'] ?? '';
              unset($input['sec3_order_no'], $input['sec3_title'], $input['sec3_txt1']);
              DB::table('multi_text')->where('section', 'faq-section')->delete();
              $sec1s = ['order_no' => $sec3['order_no'], 'title' => $sec3['title'], 'txt1' => $sec3['txt1']];
              saveMultiText($sec1s, 'faq-section');

            // pr($input);
            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_projects', $this->data);
    }
    public function our_providers(Request $request)
    {
        // has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = [];
            }
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }

            // pr($input);
            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_our_providers', $this->data);
    }

    public function contact(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 5; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_contact', $this->data);
    }

    public function impact(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 7; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_impact', $this->data);
    }

    public function caseStudy(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 7; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            // row repeater
            $sec2['title'] = $input['sec2_title'] ?? '';
            $sec2['txt1'] = $input['sec2_txt1'] ?? '';
            $sec2['order_no'] = $input['sec2_order_no'] ?? '';
            $sec2Phto['pics'] = $input['sec2_pics'] ?? '';


            unset($input['sec2_pics'], $input['sec2_order_no'], $input['sec2_title'], $input['sec2_txt1']);
            DB::table('multi_text')->where('section', 'caseStudy-section2')->delete();
            $sec1s = ['order_no' => $sec2['order_no'], 'title' => $sec2['title'], 'txt1' => $sec2['txt1']];
            // pr($sec1Phto);
            if (!empty($request->file('sec2_image')) || !empty($sec2Phto['pics'])) {
                saveMultiMediaFieldsImgs('public/images/', $request->file('sec2_image'), 'sec2_image', 'caseStudy-section2', $sec2Phto['pics'], $sec1s);
            }
            unset($input['sec2_image']);

            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_caseStudy', $this->data);
    }
    public function caseStudyDetail(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 7; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            // row repeater
            // pr($input);
            $sec2['title'] = $input['sec1_title'] ?? '';
            $sec2['txt1'] = $input['sec1_txt1'] ?? '';
            $sec2['order_no'] = $input['sec1_order_no'] ?? '';

            // $sec4Phto['pics'] = $input['sec4_pics'] ?? '';
            unset($input['sec1_order_no'], $input['sec1_title'], $input['sec1_txt1']);
            DB::table('multi_text')->where('section', 'caseStudyDetail-section1')->delete();
            $sec1s = ['order_no' => $sec2['order_no'], 'title' => $sec2['title'], 'txt1' => $sec2['txt1']];
            saveMultiText($sec1s, 'caseStudyDetail-section1');

            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_caseStudyDetail', $this->data);
    }

    public function terms(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_terms', $this->data);
    }

    public function privacy_policy(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_privacy_policy', $this->data);
    }

    public function request(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_request', $this->data);
    }

    public function about(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            // return $input;

            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 14; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }

            $sec1['title'] = $input['sec1_title'] ?? '';
            $sec1['txt1'] = $input['sec1_txt1'] ?? '';
            $sec1['order_no'] = $input['sec1_order_no'] ?? '';
            // $sec4Phto['pics'] = $input['sec4_pics'] ?? '';
            unset($input['sec1_order_no'], $input['sec1_title'], $input['sec1_txt1']);
            DB::table('multi_text')->where('section', 'timeline-section')->delete();
            $sec1s = ['order_no' => $sec1['order_no'], 'title' => $sec1['title'], 'txt1' => $sec1['txt1']];
            saveMultiText($sec1s, 'timeline-section');

            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_about', $this->data);
    }

    public function real_time(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 14; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_real_time', $this->data);
    }

    public function price_report(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 14; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_price_report', $this->data);
    }

    public function signup(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_signup', $this->data);
    }
    public function login(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_login', $this->data);
    }

    public function forgot(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_forgot', $this->data);
    }
    public function reset(Request $request)
    {
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent();
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            $content_row = unserialize($page->code);
            if (!is_array($content_row)) {
                $content_row = [];
            }
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif|max:40000',
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_reset', $this->data);
    }
}
