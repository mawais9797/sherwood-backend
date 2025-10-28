@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    @if (request()->segment(3) == 'edit' || request()->segment(3) == 'add')
        {!! breadcrumb('Add/Update Services') !!}
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
                                    <h4 class="card-title">Services Block</h4>

                                    <div class="row mb-3">

                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ !empty($row->title) ? $row->title : '' }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="heading" class="form-label"> Heading</label>
                                            <input type="text" class="form-control" name="heading"
                                                value="{{ !empty($row->heading) ? $row->heading : '' }}" required>
                                        </div>



                                        <div class="col-md-6">
                                            <label for="slug" class="form-label">Slug</label>
                                            <input type="text" class="form-control" name="slug"
                                                value="{{ !empty($row->slug) ? $row->slug : '' }}">
                                        </div>


                                    </div>




                                    <div class="mb-3">
                                        <div class="form-check form-switch py-2">
                                            <input class="form-check-input success" type="checkbox" id="color-success"
                                                {{ !empty($row) ? ($row->status == 1 ? 'checked' : '') : '' }}
                                                name="status" />
                                            <label class="form-check-label" for="color-success">
                                                {{ !empty($row) ? ($row->status == 0 ? 'InActive' : 'Active') : 'Status' }}</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch py-2">
                                            <input class="form-check-input success" type="checkbox" id="color-success2"
                                                {{ !empty($row) ? ($row->featured == 1 ? 'checked' : '') : '' }}
                                                name="featured" />
                                            <label class="form-check-label" for="color-success2">
                                                {{ !empty($row) ? ($row->featured == 0 ? 'Not Featured' : 'Featured') : 'Featured' }}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <h4 class="card-title">Intro Short Description </h4>
                                        <div class="mb-3">
                                            <label for="short_desc" class="form-label">Text</label>
                                            <textarea class="editor" name="short_desc" required>{{ !empty($row) ? $row->short_desc : '' }}</textarea>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Icon Image</h4>
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('services', !empty($row) ? $row->image1 : '') }}"
                                                alt="matdash-img" class="img-fluid" width="120" height="120">
                                        </div>
                                        <input class="form-control uploadFile" name="image1" type="file"
                                            data-bs-original-title="" title="">
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Main Image</h4>
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('services', !empty($row) ? $row->image2 : '') }}"
                                                alt="matdash-img" class="img-fluid" width="120" height="120">
                                        </div>
                                        <input class="form-control uploadFile" name="image2" type="file"
                                            data-bs-original-title="" title="">
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4 class="card-title">Detail Page Content (Section 1) </h4>

                        <div class="col-lg-12 d-flex align-items-stretch">


                            <div class="card w-100 border position-relative overflow-hidden">

                                <div class="card-body p-4">
                                    <h4 class="card-title">(What We Offer) </h4>

                                    <label for="sec1_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="sec1_title"
                                        value="{{ !empty($row->sec1_title) ? $row->sec1_title : '' }}" required>
                                </div>
                                <div class="card-body p-4">
                                    <label for="sec1_heading" class="form-label"> Heading</label>
                                    <input type="text" class="form-control" name="sec1_heading"
                                        value="{{ !empty($row->sec1_heading) ? $row->sec1_heading : '' }}" required>
                                </div>
                                <div class="card-body p-4">
                                    <h4 class="card-title">Details Block </h4>
                                    <div class="mb-3">
                                        <label for="sec1_detail" class="form-label">Text</label>
                                        <textarea class="editor" name="sec1_detail" required>{{ !empty($row) ? $row->sec1_detail : '' }}</textarea>
                                    </div>


                                </div>
                            </div>
                        </div>



                        <h4 class="card-title">Detail Page Content (Section 2) </h4>

                        <div class="col-lg-12 d-flex align-items-stretch">


                            <div class="card w-100 border position-relative overflow-hidden">


                                <div class="card-body p-4">
                                    <label for="sec2_heading" class="form-label"> Heading</label>
                                    <input type="text" class="form-control" name="sec2_heading"
                                        value="{{ !empty($row->sec2_heading) ? $row->sec2_heading : '' }}" required>
                                </div>
                                <div class="card-body p-4">
                                    <h4 class="card-title">Details Block </h4>
                                    <div class="mb-3">
                                        <label for="sec2_detail" class="form-label">Text</label>
                                        <textarea class="editor" name="sec2_detail" required>{{ !empty($row) ? $row->sec2_detail : '' }}</textarea>
                                    </div>


                                </div>
                            </div>
                        </div>



                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Add Service System</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-nowrap mb-0 newTable" id="newTable">
                                                    <thead class="header-item">
                                                        <tr>
                                                            <th width="25%">Image</th>
                                                            <th width="25%"> Title</th>
                                                            <th width="10%">Order No.</th>
                                                            <th width="5%">
                                                                <div class="action-btn">
                                                                    <a href="javascript:void(0)"
                                                                        class="text-primary edit addNewRowTbl"
                                                                        id="addNewRowTbl">
                                                                        <i class="ti ti-plus fs-6 fw-bold"></i>
                                                                    </a>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="toolRepeater">
                                                        @php
                                                            $colours = isset($row) ? getServiceBlock($row->id) : [];
                                                            $count = 1;
                                                        @endphp

                                                        @if (countlength($colours) > 0)
                                                            @foreach ($colours as $colour)
                                                                <tr class="tool-row">

                                                                    <td>
                                                                        <div class="d-flex align-items-center"
                                                                            id="imgDiv">
                                                                            <input type="file" name="colour_image[]"
                                                                                accept="image/*" id="newImgInput"
                                                                                style="display: none;" />
                                                                            <img src="{{ get_site_image_src('services', !empty($colour->colour_image) ? $colour->colour_image : '') }}"
                                                                                alt="avatar" class=""
                                                                                style="width: 60%; cursor: pointer;background:#ddd"
                                                                                id="newImg">

                                                                        </div>
                                                                    </td>
                                                                    <input type="hidden" name="colour_id[]"
                                                                        value="{{ $colour->id }}">
                                                                    <td>
                                                                        <input type="text" name="colour_name[]"
                                                                            class="form-control"
                                                                            value="{{ $colour->title }}"
                                                                            placeholder=" Title" required>
                                                                    </td>


                                                                    <td>
                                                                        <input type="number" name="order_no[]"
                                                                            class="form-control"
                                                                            value="{{ $colour->order_no }}"
                                                                            min="0" placeholder="Order No."
                                                                            required>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-btn">
                                                                            @if ($count >= 1)
                                                                                <a href="javascript:void(0)"
                                                                                    class="text-primary edit delNewRowTbl">
                                                                                    <i class="ti ti-minus fs-5"></i>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </td>


                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="tool-row">
                                                                <td>
                                                                    <div class="d-flex align-items-center" id="imgDiv">
                                                                        <input type="file" name="colour_image[]"
                                                                            accept="image/*" id="newImgInput"
                                                                            style="display: none;" />
                                                                        <img height="100px" width="100px"
                                                                            src="{{ asset('/images/no-image.svg') }}"
                                                                            alt="avatar"
                                                                            style="width: 100%; cursor: pointer;background:#ddd"
                                                                            id="newImg">
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <input type="text" name="colour_name[]"
                                                                        class="form-control" placeholder=" Title"
                                                                        required>
                                                                </td>


                                                                <td>
                                                                    <input type="number" name="order_no[]"
                                                                        class="form-control" placeholder="Order No."
                                                                        min="0" required>
                                                                </td>
                                                                <td>
                                                                    <div class="action-btn"></div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
        {!! breadcrumb('Services', url('admin/services/add/')) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>Sr#</th>
                                    <th>Main Image</th>
                                    <th>Title</th>
                                    <th>Heading</th>




                                    <th>Status</th>
                                    <th>Featured</th>
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
                                                    <img src="{{ get_site_image_src('services', !empty($row->image1) ? $row->image1 : '') }}"
                                                        width="45" class="rounded-circle" />
                                                    {{-- <h6 class="mb-0"> {{ $row->title }}</h6> --}}
                                                </div>

                                            </td>
                                            <td>

                                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                                    <h6 class="mb-0"> {{ $row->title }}</h6>
                                                </div>

                                            </td>


                                            <td>{!! short_text($row->heading) !!}</td>
                                            <td>{!! getStatus($row->status) !!}</td>
                                            <td>{!! getFeatured($row->featured) !!}</td>
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
                                                                href="{{ url('admin/services/edit/' . $row->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                                href="{{ url('admin/services/delete/' . $row->id) }}"
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
