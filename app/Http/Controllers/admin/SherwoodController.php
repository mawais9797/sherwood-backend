<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events_model;
use Illuminate\Http\Request;

class SherwoodController extends Controller
{
    public function index()
    {
        $this->data['row'] = Events_model::orderBy('id', 'DESC')->get();
        // return view('admin.events.index', $this->data);
        return view('admin.website_pages.site_home_sherwood', $this->data);
    }

    public function sherwood_cms_add(){

    }

    public function eventsCRUD()
    {
        $this->data['rows'] = Events_model::orderBy('id', 'DESC')->get();
        return view('admin.events.index', $this->data);
    }

    public function add(Request $request)
    {
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

            $data['title'] = $input['title'];
            // $data['description'] = $input['description'];

            // $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'services');
            $data['description'] = $input['description'];
            $data['date']        = $input['date'];
            $data['start_time']  = $input['start_time'];

            $data['end_time'] = $input['end_time'];

            // pr($data);

            $id = Events_model::create($data)->id;

            // $this->saveServiceBlock($id, $input);

            return redirect('admin/events/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.events.index', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $event = Events_model::find($id);
        // pr($event);
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
                    if (! empty($event->$oldImageField)) {
                        removeImage("events/" . $event->$oldImageField);
                    }

                    // New image assign karna
                    // $event->$oldImageField = basename($image);
                    $event->$oldImageField = basename($image);
                }
            }
            // }

            $event->title = $input['title'];
            // $data['description'] = $input['description'];

            // $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'services');
            $event->description = $input['description'];
            $event->date        = $input['date'];
            $event->start_time  = $input['start_time'];

            $event->end_time = $input['end_time'];

            // pr($data);

            $event->update();

            // $this->saveServiceBlock($id, $input);

            return redirect('admin/sherwoodcontroller/events')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row']           = Events_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.events.index', $this->data);
    }

    public function delete($id)
    {
        $event = Events_model::find($id);
        removeImage("events/" . $event->image);
        $event->delete();
        return redirect('admin/sherwoodcontroller/events')
            ->with('error', 'Content deleted Successfully');
    }
}
