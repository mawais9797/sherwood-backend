<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery_model;
use Illuminate\Http\Request;

class SherwoodGalleryController extends Controller
{
    public function index()
    {
        $this->data['rows'] = Gallery_model::orderBy('id', 'DESC')->get();
        return view('admin.gallery.index', $this->data);
    }

    public function add(Request $request){
        $input = $request->all();
         if ($input) {
            $data = [];
            // for ($i = 1; $i <= 5; $i++) {
            $field = 'image';

            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000',
                ]);

                $image = $request->file($field)->store('public/gallery/');

                if (! empty(basename($image))) {
                    $data[$field] = basename($image);
                }
            }

           if (!empty($input['status'])) {
                 $data['status'] = 1;
            } else {
                 $data['status'] = 0;
            }
            $id = Gallery_model::create($data)->id;

            // $this->saveServiceBlock($id, $input);

            return redirect('admin/gallery/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.gallery.index', $this->data);
    }


    public function edit(Request $request, $id){
        $GalleryImage = Gallery_model::find($id);
        $input = $request->all();
        // pr($input);
         if ($input) {
            $data = [];
            // for ($i = 1; $i <= 5; $i++) {
            $field = 'image';

            if ($request->hasFile($field)) {
                $request->validate([
                    $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000',
                ]);

                $image = $request->file($field)->store('public/gallery/');

                 if (! empty($image)) {
                    // Old image delete karne ka logic
                    $oldImageField = 'image';
                    if (! empty($GalleryImage->$oldImageField)) {
                        removeImage("Galler$GalleryImages/" . $GalleryImage->$oldImageField);
                    }

                    // New image assign karna
                    // $GalleryImage->$oldImageField = basename($image);
                    $GalleryImage->$oldImageField = basename($image);
                }
            }

            // $GalleryImage->status = $input['status'];
            if (!empty($input['status'])) {
                $GalleryImage->status = 1;
            } else {
                $GalleryImage->status = 0;
            }

            // pr($GalleryImage);
            $GalleryImage->update();
            // $this->saveServiceBlock($id, $input);

            return redirect('admin/gallery/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Gallery_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.gallery.index', $this->data);
    }

     public function delete($id)
    {
        $GalleryImage = Gallery_model::find($id);
        removeImage("gallery/" . $GalleryImage->image);
        $GalleryImage->delete();
        return redirect('admin/gallery/')
            ->with('error', 'Content deleted Successfully');
    }
}
