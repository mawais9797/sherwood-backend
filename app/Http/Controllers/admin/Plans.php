<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Plans_model;

class Plans extends Controller
{
    public function index()
    {
        $this->data['rows'] = Plans_model::orderBy('id', 'DESC')->get();
        return view('admin.plans.index', $this->data);
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
            // if ($request->hasFile('image')) {

            //     $request->validate([
            //         'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
            //     ]);
            //     $image = $request->file('image')->store('public/categories/');
            //     if (!empty(basename($image))) {
            //         $data['image'] = basename($image);
            //     }
            // }
            $data['name'] = $input['name'];
            $data['plan_type'] = $input['plan_type'];
            $data['price'] = $input['price'];
            $data['txt1'] = $input['txt1'];
            $data['txt2'] = $input['txt2'];
            $data['stripe_id'] = $input['stripe_id'];


            // $data['slug'] = checkSlug(Str::slug($data['name'], '-'), 'categories');
            // pr($data);
            $id = Plans_model::create($data);
            return redirect('admin/plans/')
                ->with('success', 'Content Updated Successfully');
        }

        return view('admin.plans.index', $this->data);
    }
    public function edit(Request $request, $id)
    {

        $plan = Plans_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();
            // pr($input['status']);
            if (!empty($input['status'])) {
                $plan->status = 1;
            } else {
                $plan->status = 0;
            }
            // if ($request->hasFile('image')) {

            //     $request->validate([
            //         'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
            //     ]);
            //     $image = $request->file('image')->store('public/categories/');
            //     if (!empty($image)) {
            //         $plan->image = basename($image);
            //     }
            // }
            $plan->name = $input['name'];
            $plan->plan_type = $input['plan_type'];
            $plan->price = $input['price'];
            $plan->txt1 = $input['txt1'];
            $plan->txt2 = $input['txt2'];
            $plan->stripe_id = $input['stripe_id'];

            // $plan->slug = checkSlug(Str::slug($plan->name, '-'), 'categories', $plan->id);

            // pr($plan);
            $plan->update();
            return redirect('admin/plans/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Plans_model::find($id);
        return view('admin.plans.index', $this->data);
    }
    public function delete($id)
    {
        $plan = Plans_model::find($id);
        // removeImage("categories/" . $plan->image);
        $plan->delete();
        return redirect('admin/plans/')
            ->with('error', 'Content deleted Successfully');
    }
}
