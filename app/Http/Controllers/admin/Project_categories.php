<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Project_categories_model;
use App\Http\Controllers\Controller;

class Project_categories extends Controller
{

    public function index()
    {
        // has_access(18);
        $this->data['rows'] = Project_categories_model::orderBy('id', 'DESC')->get();
        return view('admin.projects.project_categories', $this->data);
    }
    public function add(Request $request)
    {
        // has_access(18);
        $input = $request->all();
        if ($input) {
            $data = array();
            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            $data['name'] = $input['name'];

            $data['slug'] = checkSlug(Str::slug($data['name'], '-'), 'project_categories');


            // pr($data);
            $id = Project_categories_model::create($data);
            return redirect('admin/project_categories/')
                ->with('success', 'Content Updated Successfully');
        }


        return view('admin.projects.project_categories', $this->data);
    }
    public function edit(Request $request, $id)
    {
        // has_access(18);
        $category = Project_categories_model::find($id);
        $input = $request->all();

        if ($input) {
            $data = array();
            // pr($input['status']);
            if (!empty($input['status'])) {
                $category->status = 1;
            } else {
                $category->status = 0;
            }





            $category->name = $input['name'];
            // $category->image=  $input['image'];

            $category->slug = checkSlug(Str::slug($category->name, '-'), 'project_categories', $category->id);


            // pr($category);
            $category->update();
            return redirect('admin/project_categories/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Project_categories_model::find($id);
        // return  $this->data['row'];
        return view('admin.projects.project_categories', $this->data);
    }
    public function delete($id)
    {
        // has_access(18);
        $category = Project_categories_model::find($id);
        $category->delete();
        return redirect('admin/project_categories/')
            ->with('error', 'Content deleted Successfully');
    }
}
