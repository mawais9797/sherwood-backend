<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Case_study_categories_model;
use App\Models\Case_study_model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Case_study extends Controller
{
    public function index()
    {
        // has_access(17);
        $this->data['rows'] = Case_study_model::orderBy('id', 'DESC')->get();
        foreach ($this->data['rows'] as $row) {
            $row->cat_name = $row->category_row->name;
        }
        return view('admin.case_study.index', $this->data);
    }
    public function add(Request $request)
    {
        // has_access(17);
        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/case_study/');
                if (!empty(basename($image))) {
                    generateThumbnail('case_study', basename($image), 'square', 'large');
                    $data['image'] = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            if (!empty($input['popular'])) {
                $data['popular'] = 1;
            } else {
                $data['popular'] = 0;
            }
            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];
            // $data['tags']=$input['tags'];
            $data['title']        = $input['title'];
            $data['slug']         = checkSlug(Str::slug($data['title'], '-'), 'case_study');
            $data['short_desc']   = $input['short_desc'];
            $data['publish_date'] = $input['publish_date'];
            $data['reading_time'] = $input['reading_time'];
            $data['author_name']  = $input['author_name'];


            $data['heading']      = $input['heading'];
            $data['detail']       = $input['detail'];
            $data['table_content']       = $input['table_content'];

            $data['category']     = $input['category'];
            // pr($data);


            $id = Case_study_model::create($data);
            return redirect('admin/case_study/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        $this->data['categories'] = Case_study_categories_model::where('status', 1)->get();
        return view('admin.case_study.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        // has_access(17);
        $case_study = Case_study_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/case_study/');
                if (!empty($image)) {
                    if (!empty($case_study->image)) {
                        removeImage("case_study/" . $case_study->image);
                    }
                    generateThumbnail('case_study', basename($image), 'square', 'large');
                    $case_study->image = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $case_study->status = 1;
            } else {
                $case_study->status = 0;
            }

            if (!empty($input['popular'])) {
                $case_study->popular = 1;
            } else {
                $case_study->popular = 0;
            }
            $case_study->meta_title = $input['meta_title'];
            $case_study->meta_description = $input['meta_description'];
            $case_study->meta_keywords = $input['meta_keywords'];

            $case_study->title        = $input['title'];
            $case_study->slug         = checkSlug(Str::slug($case_study->title, '-'), 'case_study', $case_study->id);
            $case_study->short_desc   = $input['short_desc'];
            $case_study->publish_date = $input['publish_date'];
            $case_study->reading_time = $input['reading_time'];
            $case_study->author_name  = $input['author_name'];


            $case_study->heading      = $input['heading'];
            $case_study->detail       = $input['detail'];
            $case_study->table_content       = $input['table_content'];

            $case_study->category     = $input['category'];


            // pr($data);
            $case_study->update();
            return redirect('admin/case_study/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Case_study_model::find($id);
        $this->data['enable_editor'] = true;
        $this->data['categories'] = Case_study_categories_model::where('status', 1)->get();
        return view('admin.case_study.index', $this->data);
    }
    public function delete($id)
    {
        // has_access(17);
        $case_study = Case_study_model::find($id);
        if (!empty($case_study->image)) {
            removeImage("case_study/" . $case_study->image);
        }
        $case_study->delete();
        return redirect('admin/case_study/')
            ->with('error', 'Content deleted Successfully');
    }
}
