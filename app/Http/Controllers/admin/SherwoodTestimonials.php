<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonials_Sherwood_model;
use Illuminate\Http\Request;

class SherwoodTestimonials extends Controller
{
    public function index()
    {
        $this->data['rows'] = Testimonials_Sherwood_model::orderBy('id', 'DESC')->get();
        // pr($this->data);
        return view('admin.testimonials_sherwood.index', $this->data);
    }

    public function add(Request $request)
    {
        // die('here');
        $input = $request->all();
        if ($input) {
            $data = [];
            // for ($i = 1; $i <= 5; $i++) {
            $field = 'image';

            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000',
                ]);

                $image = $request->file($field)->store('public/events/');

                if (! empty(basename($image))) {
                    $data[$field] = basename($image);
                }
            }
            // }

            // $data['description'] = $input['description'];

            // $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'services');
            $data['name']        = $input['name'];
            $data['designation'] = $input['designation'];
            $data['message']     = $input['message'];

            // pr($data);

            $id = Testimonials_Sherwood_model::create($data)->id;

            // $this->saveServiceBlock($id, $input);

            return redirect('admin/sherwoodtestimonials/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.testimonials_sherwood.index', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $testimonial = Testimonials_Sherwood_model::find($id);
        // die('here');
        $input = $request->all();
        if ($input) {
            $data = [];
            // for ($i = 1; $i <= 5; $i++) {
            $field = 'image';

            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000',
                ]);

                $image = $request->file($field)->store('public/events/');

                if (! empty($image)) {
                    // Old image delete karne ka logic
                    $oldImageField = 'image';
                    if (! empty($services->$oldImageField)) {
                        removeImage("events/" . $services->$oldImageField);
                    }

                    // New image assign karna
                    // $services->$oldImageField = basename($image);
                    $testimonial->$oldImageField = basename($image);
                }
            }

            // if (!empty(basename($image))) {
            //     $data[$field] = basename($image);
            // }
            $testimonial->name        = $input['name'];
            $testimonial->designation = $input['designation'];
            $testimonial->message     = $input['message'];

            // pr($testimonial);

            $testimonial->update();
            // $this->saveServiceBlock($id, $input);

            return redirect('admin/sherwoodtestimonials/')
                ->with('success', 'Content Updated Successfully');

        }

        $this->data['row']           = Testimonials_Sherwood_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.testimonials_sherwood.index', $this->data);
    }

    public function delete($id)
    {
        $testimonial = Testimonials_Sherwood_model::find($id);
        removeImage("events/" . $testimonial->image);
        $testimonial->delete();
        return redirect('admin/sherwoodtestimonials/')
            ->with('error', 'Content deleted Successfully');
    }

}
