@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    @if (request()->segment(3) == 'edit' || request()->segment(3) == 'add')
        {!! breadcrumb('Add/Update Events') !!}
        <form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Meta Information Block </h4>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Meta Title</label>
                                        <input class="form-control" id="meta_title" type="text" name="meta_title"
                                            placeholder="" value="{{ !empty($row->meta_title) ? $row->meta_title : '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" rows="3" name="meta_description">{{ !empty($row->meta_description) ? $row->meta_description : '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Meta Keywords</label>
                                        <textarea class="form-control" id="meta_keywords" rows="3" name="meta_keywords">{{ !empty($row->meta_keywords) ? $row->meta_keywords : '' }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Event Block</h4>

                                    <div class="row mb-3">

                                        <div class="col-md-12 mb-5">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ !empty($row->title) ? $row->title : '' }}" required>
                                        </div>

                                        <div class="col-md-12">
                                            <h4 class="card-title">Intro Short Description </h4>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Text</label>
                                                <textarea class="editor" name="description" required>{{ !empty($row) ? $row->description : '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-5">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" name="date"
                                                value="{{ !empty($row->date) ? $row->date : '' }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="start_time" class="form-label">Start Time</label>
                                            <input type="time" class="form-control" name="start_time"
                                                value="{{ !empty($row->start_time) ? $row->start_time : '' }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="end_time" class="form-label">End Time</label>
                                            <input type="time" class="form-control" name="end_time"
                                                value="{{ !empty($row->end_time) ? $row->end_time : '' }}" required>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Event Image</h4>
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('events', !empty($row) ? $row->image : '') }}"
                                                alt="matdash-img" class="img-fluid" width="120" height="120">
                                        </div>
                                        <input class="form-control uploadFile" name="image" type="file"
                                            data-bs-original-title="" title="">
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    @else
        {!! breadcrumb('Events Sherwood', url('admin/events/add/')) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>Sr#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @if (!empty($rows))
                                    @foreach ($rows as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                                    <h6 class="mb-0"> {{ $row->title }}</h6>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                                    <img src="{{ get_site_image_src('events', !empty($row->image) ? $row->image : '') }}"
                                                        width="45" class="rounded-circle" />

                                                    {{-- <h6 class="mb-0"> {{ $row->title }}</h6> --}}
                                                </div>
                                            </td>

                                            <td>{!! short_text($row->description) !!}</td>
                                            <td>{{ $row->date }}</td>

                                            <td>
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0)" class="text-muted"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ti ti-dots-vertical fs-6"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                                href="{{ url('admin/events/edit/' . $row->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                                href="{{ url('admin/events/delete/' . $row->id) }}"
                                                                onclick="return confirm('Are you sure?');">
                                                                <i class="fs-4 ti ti-trash"></i>Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="odd">
                                        <td colspan="4">No record(s) found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
