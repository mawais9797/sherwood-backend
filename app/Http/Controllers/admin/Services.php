<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services_model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;



class Services extends Controller
{
    public function index()
    {
        $this->data['rows'] = Services_model::orderBy('id', 'DESC')->get();
        return view('admin.services.index', $this->data);
    }
    public function add(Request $request)
    {

        $input = $request->all();
        if ($input) {
            $data = array();
            for ($i = 1; $i <= 5; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {
                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/services/');

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
            $data['heading'] = $input['heading'];
            $data['short_desc'] = $input['short_desc'];

            $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'services');
            $data['sec1_title'] = $input['sec1_title'];
            $data['sec1_heading'] = $input['sec1_heading'];
            $data['sec1_detail'] = $input['sec1_detail'];

            $data['sec2_heading'] = $input['sec2_heading'];
            $data['sec2_detail'] = $input['sec2_detail'];

            // pr($data);

            $id = Services_model::create($data)->id;


            $this->saveServiceBlock($id, $input);


            return redirect('admin/services/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.services.index', $this->data);
    }
    public function edit(Request $request, $id)
    {

        $services = Services_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();
            for ($i = 1; $i <= 5; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {

                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/services/');

                    if (!empty($image)) {
                        // Old image delete karne ka logic
                        $oldImageField = 'image' . $i;
                        if (!empty($services->$oldImageField)) {
                            removeImage("services/" . $services->$oldImageField);
                        }

                        // New image assign karna
                        $services->$oldImageField = basename($image);
                    }
                }
            }
            if (!empty($input['status'])) {
                $services->status = 1;
            } else {
                $services->status = 0;
            }

            if (!empty($input['featured'])) {
                $services->featured = 1;
            } else {
                $services->featured = 0;
            }

            $services->meta_title = $input['meta_title'];
            $services->meta_description = $input['meta_description'];
            $services->meta_keywords = $input['meta_keywords'];

            $services->title = $input['title'];
            $services->heading = $input['heading'];
            $services->short_desc = $input['short_desc'];

            $services->slug = checkSlug(Str::slug($services->title, '-'), 'services', $services->id);

            $services->sec1_title = $input['sec1_title'];
            $services->sec1_heading = $input['sec1_heading'];
            $services->sec1_detail = $input['sec1_detail'];

            $services->sec2_heading = $input['sec2_heading'];
            $services->sec2_detail = $input['sec2_detail'];

            // pr($data);
            $services->update();

            $this->saveServiceBlock($services->id, $input);


            return redirect('admin/services/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Services_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.services.index', $this->data);
    }



    public function saveServiceBlock($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['colour_name'])) {
            foreach ($input['colour_name'] as $i => $colour_name) {
                $imageName = null;
                $colourId = $input['colour_id'][$i] ?? null;

                // pr($colourId);


                if (isset($input['colour_image'][$i]) && $input['colour_image'][$i]->isValid()) {
                    $image = $input['colour_image'][$i];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('services', $imageName, 'public');
                } elseif ($colourId) {
                    $existing = DB::table('servicesblock')->where('id', $colourId)->first();
                    $imageName = $existing->colour_image ?? null;
                }

                if ($colourId) {
                    DB::table('servicesblock')->where('id', $colourId)->update([
                        'title' => $colour_name,
                        'order_no' => $input['order_no'][$i] ?? 0,
                        'colour_image' => $imageName,

                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $colourId;
                } else {
                    $newId = DB::table('servicesblock')->insertGetId([
                        'service_id' => $productId,
                        'title' => $colour_name,
                        'order_no' => $input['order_no'][$i] ?? 0,
                        'colour_image' => $imageName,

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        DB::table('servicesblock')
            ->where('service_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }


    public function delete($id)
    {
        $services = Services_model::find($id);
        removeImage("services/" . $services->image);
        $services->delete();
        return redirect('admin/services/')
            ->with('error', 'Content deleted Successfully');
    }
}
