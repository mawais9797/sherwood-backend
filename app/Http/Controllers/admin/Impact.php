<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Impact_model;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Str;



class Impact extends Controller
{
    public function index()
    {
        $this->data['rows'] = Impact_model::orderBy('id', 'DESC')->get();
        return view('admin.impact.index', $this->data);
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



            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];

            $data['title'] = $input['title'];


            $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'impact');


            // pr($data);

            $id = Impact_model::create($data)->id;


            $this->impactBlock($id, $input);


            return redirect('admin/impact/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.impact.index', $this->data);
    }
    public function edit(Request $request, $id)
    {

        $impact = Impact_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();

            if (!empty($input['status'])) {
                $impact->status = 1;
            } else {
                $impact->status = 0;
            }



            $impact->meta_title = $input['meta_title'];
            $impact->meta_description = $input['meta_description'];
            $impact->meta_keywords = $input['meta_keywords'];

            $impact->title = $input['title'];

            $impact->slug = checkSlug(Str::slug($impact->title, '-'), 'impact', $impact->id);


            // pr($data);
            $impact->update();

            $this->impactBlock($impact->id, $input);


            return redirect('admin/impact/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Impact_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.impact.index', $this->data);
    }


    public function impactBlock($impactId, $input)
    {
        $processedIds = [];

        if (!empty($input['heading'])) {
            foreach ($input['heading'] as $i => $heading) {
                $colourId = $input['colour_id'][$i] ?? null;

                $data = [
                    'heading'     => $heading,
                    'short_desc'  => $input['short_desc'][$i] ?? null,
                    'link'        => $input['link'][$i] ?? null,
                    'order_no'    => $input['order_no'][$i] ?? 0,
                    'updated_at'  => now(),
                ];

                if ($colourId) {
                    DB::table('impactblock')->where('id', $colourId)->update($data);
                    $processedIds[] = $colourId;
                } else {
                    $data['impact_id'] = $impactId;
                    $data['created_at'] = now();

                    $newId = DB::table('impactblock')->insertGetId($data);
                    $processedIds[] = $newId;
                }
            }
        }

        // Delete old rows not in processed
        DB::table('impactblock')
            ->where('impact_id', $impactId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }


    public function delete($id)
    {
        $impact = Impact_model::find($id);
        removeImage("impact/" . $impact->image);
        $impact->delete();
        return redirect('admin/impact/')
            ->with('error', 'Content deleted Successfully');
    }
}
