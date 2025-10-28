<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial_model;
use Illuminate\Http\Request;

class Testimonials extends Controller
{
    public function index()
    {
        $this->data['rows'] = Testimonial_model::orderBy('id', 'DESC')->get();
        return view('admin.testimonials.index', $this->data);
    }
    public function add(Request $request)
    {

        $input = $request->all();
        if ($input) {
            $data = array();


            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            if (!empty($input['featured'])) {
                $data['featured'] = 1;
            } else {
                $data['featured'] = 0;
            }

            $data['name'] = $input['name'];
            $data['designation'] = $input['designation'];

            $data['message'] = $input['message'];
            // pr($data);
            $id = Testimonial_model::create($data);
            return redirect('admin/testimonials/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.testimonials.index', $this->data);
    }
    public function edit(Request $request, $id)
    {

        $testimonial = Testimonial_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();


            if (!empty($input['status'])) {
                $testimonial->status = 1;
            } else {
                $testimonial->status = 0;
            }

            if (!empty($input['featured'])) {
                $testimonial->featured = 1;
            } else {
                $testimonial->featured = 0;
            }
            $testimonial->name = $input['name'];
            $testimonial->designation = $input['designation'];

            $testimonial->message = $input['message'];
            // pr($data);
            $testimonial->update();
            return redirect('admin/testimonials/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Testimonial_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.testimonials.index', $this->data);
    }
    public function delete($id)
    {
        $testimonial = Testimonial_model::find($id);
        // removeImage("testimonials/".$testimonial->image);
        $testimonial->delete();
        return redirect('admin/testimonials/')
            ->with('error', 'Content deleted Successfully');
    }
}
