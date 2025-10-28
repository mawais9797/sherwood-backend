<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Projects_model;
use App\Models\Project_categories_model;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Projects extends Controller
{
    public function index()
    {
        // has_access(17);
        $this->data['rows'] = Projects_model::orderBy('id', 'DESC')->get();

        // foreach ($this->data['rows'] as $row) {
        //     $row->cat_name = $row->category_row->name;
        // }

        return view('admin.projects.index', $this->data);
    }
    public function add(Request $request)
    {
        // has_access(17);
        $input = $request->all();
        // pr($input);
        if ($input) {
            $data = array();



            for ($i = 1; $i <= 5; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {
                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/projects/');

                    if (!empty(basename($image))) {
                        $data[$field] = basename($image);
                    }
                }
            }



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
            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];

            $data['title'] = $input['title'];
            $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'projects');
            $data['heading'] = $input['heading'];
            $data['short_desc'] = $input['short_desc'];

            $data['category'] = $input['category'];


            $data['detail'] = $input['detail'];
            $data['description'] = $input['description'];
            $data['description2'] = $input['description2'];
            $data['description3'] = $input['description3'];






            $id = Projects_model::create($data)->id;
            // $this->saveCoverRepeater($id, $input);




            return redirect('admin/projects/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        $this->data['categories'] = Project_categories_model::where('status', 1)->get();

        return view('admin.projects.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        // has_access(17);
        $project = Projects_model::find($id);
        $input = $request->all();
        // pr($input);
        if ($input) {
            $data = array();



            for ($i = 1; $i <= 5; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {

                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/projects/');

                    if (!empty($image)) {
                        // Old image delete karne ka logic
                        $oldImageField = 'image' . $i;
                        if (!empty($project->$oldImageField)) {
                            removeImage("projects/" . $project->$oldImageField);
                        }

                        // New image assign karna
                        $project->$oldImageField = basename($image);
                    }
                }
            }



            if (!empty($input['status'])) {
                $project->status = 1;
            } else {
                $project->status = 0;
            }

            if (!empty($input['featured'])) {
                $project->featured = 1;
            } else {
                $project->featured = 0;
            }
            $project->meta_title = $input['meta_title'];
            $project->meta_description = $input['meta_description'];
            $project->meta_keywords = $input['meta_keywords'];

            $project->title = $input['title'];
            $project->slug = checkSlug(Str::slug($project->title, '-'), 'projects', $project->id);
            $project->heading = $input['heading'];
            $project->short_desc = $input['short_desc'];

            $project->category = $input['category'];


            $project->detail = $input['detail'];
            $project->description = $input['description'];
            $project->description2 = $input['description2'];

            $project->description3 = $input['description3'];




            $project->update();


            return redirect('admin/projects/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Projects_model::find($id);
        $this->data['enable_editor'] = true;
        $this->data['categories'] = Project_categories_model::where('status', 1)->get();

        return view('admin.projects.index', $this->data);
    }



    public function delete($id)
    {
        // has_access(17);
        $project = Projects_model::find($id);
        if (!empty($project->image)) {
            removeImage("projects/" . $project->image);
        }
        $project->delete();
        return redirect('admin/projects/')
            ->with('error', 'Content deleted Successfully');
    }
}
