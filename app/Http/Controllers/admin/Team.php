<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team_model;
use Illuminate\Support\Str;



class Team extends Controller
{
    public function index()
    {
        $this->data['rows'] = Team_model::orderBy('id', 'DESC')->get();
        return view('admin.team.index', $this->data);
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
                $image = $request->file('image')->store('public/team/');
                if (!empty(basename($image))) {
                    $data['image'] = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }


            $data['name'] = $input['name'];
            $data['designation'] = $input['designation'];
            $data['detail'] = $input['detail'];
            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];


            // $data['tags']=$input['tags'];
            // $data['title'] = $input['title'];
            // $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'blog');
            // $data['category'] = $input['category'];
            // pr($data);
            $id = Team_model::create($data);
            return redirect('admin/team/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.team.index', $this->data);
    }
    public function edit(Request $request, $id)
    {

        $team = Team_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();


            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/team/');
                if (!empty($image)) {
                    if (!empty($team->image)) {
                        removeImage("team/" . $team->image);
                    }

                    $team->image = basename($image);
                }
            }

            if (!empty($input['status'])) {
                $team->status = 1;
            } else {
                $team->status = 0;
            }

            $team['name'] = $input['name'];
            $team['designation'] = $input['designation'];
            $team['detail'] = $input['detail'];
            $team['meta_title'] = $input['meta_title'];
            $team['meta_description'] = $input['meta_description'];
            $team['meta_keywords'] = $input['meta_keywords'];
            // pr($data);
            $team->update();
            return redirect('admin/team/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Team_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.team.index', $this->data);
    }
    public function delete($id)
    {
        $team = Team_model::find($id);
        removeImage("team/" . $team->image);
        $team->delete();
        return redirect('admin/team/')
            ->with('error', 'Content deleted Successfully');
    }
}
