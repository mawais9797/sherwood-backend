@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!!breadcrumb('Contact Us Page')!!}
<form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="page_title">Page Title</label>
                            <input class="form-control" id="page_title" type="text" name="page_title" placeholder="" value="{{ !empty($sitecontent['page_title']) ? $sitecontent['page_title'] : "" }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="meta_title">Meta Title</label>
                            <input class="form-control" id="meta_title" type="text" name="meta_title" placeholder="" value="{{ !empty($sitecontent['meta_title']) ? $sitecontent['meta_title'] : "" }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="site_meta_desc">Meta Description</label>
                            <textarea class="form-control" id="meta_description" rows="3" name="meta_description">{{ !empty($sitecontent['meta_description']) ? $sitecontent['meta_description'] : "" }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" id="meta_keywords" rows="3" name="meta_keywords">{{ !empty($sitecontent['meta_keywords']) ? $sitecontent['meta_keywords'] : "" }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- banner --}}
    <div class="card">
        <div class="card-header">
            <h5>Banner</h5>
        </div>
        <div class="card-body">
            <div class="row">
    
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_heading">Heading</label>
                                <input class="form-control" id="banner_heading" type="text"
                                    name="banner_heading" placeholder=""
                                    value="{{ $sitecontent['banner_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         {{-- section1 --}}
         <div class="card">
            <div class="card-header">
                <h5>Section 1</h5>
            </div>
            <div class="card-body">
                <!-- 1st row: Left + Right side by side -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-12">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image1']) ? $sitecontent['image1'] : '') }}"
                                                alt="matdash-img" class="img-fluid ">
                                        </div>
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        <input class="form-control uploadFile" name="image1" type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="section1_left_text">Text</label>
                                <textarea id="section1_left_text" name="section1_left_text" rows="4" class="form-control">{{ !empty($sitecontent['section1_left_text']) ? $sitecontent['section1_left_text'] : '' }}</textarea>
                            </div>
                        </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_address">Address</label>
                                    <input class="form-control" id="section1_address" type="text" name="section1_address"
                                        value="{{ $sitecontent['section1_address'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_email">Email</label>
                                    <input type="text" class="form-control" name="section1_email"
                                        id="section1_email" value="{{ $sitecontent['section1_email'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_down_text">DownText</label>
                                    <textarea id="section1_down_text" name="section1_down_text" rows="4" class="form-control">{{ !empty($sitecontent['section1_down_text']) ? $sitecontent['section1_down_text'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    <!-- RIGHT SIDE -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="section1_right_text">Right Text</label>
                            <textarea id="section1_right_text" name="section1_right_text" rows="4" class="editor">{{ !empty($sitecontent['section1_right_text']) ? $sitecontent['section1_right_text'] : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- section1 end --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 2</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section2_heading">Heading</label>
                                            <input class="form-control" id="section2_heading" type="text"
                                                name="section2_heading" placeholder=""
                                                value="{{ $sitecontent['section2_heading'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php $how_works = 0; ?>
                                    @for ($i = 2; $i <= 4; $i++)
                                        <?php $how_works = $how_works + 1; ?>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Block {{ $how_works }}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col">
                                                        <div class="card w-100 border position-relative overflow-hidden">
                                                            <div class="card-body p-4">
                                                                <div class="text-center">
                                                                    <div class="file_choose_icon">
                                                                        <img src="{{ get_site_image_src('images', !empty($sitecontent['image' . $i]) ? $sitecontent['image' . $i] : '') }}"
                                                                            alt="matdash-img" class="img-fluid ">
                                                                    </div>
                                                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of
                                                                        800K</p>
                                                                    <input class="form-control uploadFile"
                                                                        name="image{{ $i }}" type="file"
                                                                        data-bs-original-title="" title="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-4">
                                                                <label class="form-label"
                                                                    for="sec2_heading{{ $i }}">Heading
                                                                    {{ $how_works }}</label>
                                                                <input class="form-control"
                                                                    id="sec2_heading{{ $i }}" type="text"
                                                                    name="sec2_heading{{ $i }}" placeholder=""
                                                                    value="{{ !empty($sitecontent['sec2_heading' . $i]) ? $sitecontent['sec2_heading' . $i] : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
            <button class="btn btn-primary" type="submit">Update Page</button>
        </div>
    </div>
    @endsection