<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trusted_by_model;
use Illuminate\Support\Str;



class Trusted_by extends Controller
{
    public function index()
    {
        $this->data['rows'] = Trusted_by_model::orderBy('id', 'DESC')->get();
        return view('admin.trusted_by.index', $this->data);
    }
    public function add(Request $request)
    {

        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/trusted_by/');
                if (!empty(basename($image))) {
                    $data['image'] = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            // $data['meta_title'] = $input['meta_title'];
            // $data['meta_description'] = $input['meta_description'];
            // $data['meta_keywords'] = $input['meta_keywords'];
            // $data['tags']=$input['tags'];
            // $data['title'] = $input['title'];
            // $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'blog');
            // $data['detail'] = $input['detail'];
            // $data['category'] = $input['category'];
            // pr($data);
            $id = Trusted_by_model::create($data);
            return redirect('admin/trusted_by/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.trusted_by.index', $this->data);
    }
    public function edit(Request $request, $id)
    {

        $trusted_by = Trusted_by_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();


            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/trusted_by/');
                if (!empty($image)) {
                    if (!empty($trusted_by->image)) {
                        removeImage("trusted_by/" . $trusted_by->image);
                    }

                    $trusted_by->image = basename($image);
                }
            }

            if (!empty($input['status'])) {
                $trusted_by->status = 1;
            } else {
                $trusted_by->status = 0;
            }

            // $trusted_by->meta_title = $input['meta_title'];
            // $trusted_by->meta_description = $input['meta_description'];
            // $trusted_by->meta_keywords = $input['meta_keywords'];
            // $trusted_by->tags=$input['tags'];
            // $trusted_by->title = $input['title'];
            // $trusted_by->slug = checkSlug(Str::slug($trusted_by->title, '-'), 'blog', $trusted_by->id);
            // $trusted_by->detail = $input['detail'];
            // $trusted_by->category = $input['category'];
            // pr($data);
            $trusted_by->update();
            return redirect('admin/trusted_by/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Trusted_by_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.trusted_by.index', $this->data);
    }
    public function delete($id)
    {
        $trusted_by = Trusted_by_model::find($id);
        removeImage("trusted_by/" . $trusted_by->image);
        $trusted_by->delete();
        return redirect('admin/trusted_by/')
            ->with('error', 'Content deleted Successfully');
    }
}
