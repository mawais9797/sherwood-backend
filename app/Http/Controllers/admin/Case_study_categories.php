<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Case_study_categories_model;
use App\Http\Controllers\Controller;

class Case_study_categories extends Controller
{

    public function index()
    {
        // has_access(18);
        $this->data['rows'] = Case_study_categories_model::orderBy('id', 'DESC')->get();
        return view('admin.case_study.case_study_categories', $this->data);
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
            $data['slug'] = checkSlug(Str::slug($data['name'], '-'), 'case_study_categories');
            // pr($data);
            $id = Case_study_categories_model::create($data);
            return redirect('admin/case_study_categories/')
                ->with('success', 'Content Updated Successfully');
        }

        return view('admin.case_study.case_study_categories', $this->data);
    }
    public function edit(Request $request, $id)
    {
        // has_access(18);
        $category = Case_study_categories_model::find($id);
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
            $category->slug = checkSlug(Str::slug($category->name, '-'), 'case_study_categories', $category->id);

            // pr($category);
            $category->update();
            return redirect('admin/case_study_categories/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Case_study_categories_model::find($id);
        return view('admin.case_study.case_study_categories', $this->data);
    }
    public function delete($id)
    {
        // has_access(18);
        $category = Case_study_categories_model::find($id);
        $category->delete();
        return redirect('admin/case_study_categories/')
            ->with('error', 'Content deleted Successfully');
    }
}
