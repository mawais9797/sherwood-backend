@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    {!! breadcrumb('Pricing Page') !!}
    <form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="row">
                        <div class="col">
                            <div>
                                <label class="form-label" for="page_title">Page Title</label>
                                <input class="form-control" id="page_title" type="text" name="page_title" placeholder=""
                                    value="{{ !empty($sitecontent['page_title']) ? $sitecontent['page_title'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>
                                <label class="form-label" for="meta_title">Meta Title</label>
                                <input class="form-control" id="meta_title" type="text" name="meta_title" placeholder=""
                                    value="{{ !empty($sitecontent['meta_title']) ? $sitecontent['meta_title'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>
                                <label class="form-label" for="site_meta_desc">Meta Description</label>
                                <textarea class="form-control" id="meta_description" rows="3" name="meta_description">{{ !empty($sitecontent['meta_description']) ? $sitecontent['meta_description'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>
                                <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                <textarea class="form-control" id="meta_keywords" rows="3" name="meta_keywords">{{ !empty($sitecontent['meta_keywords']) ? $sitecontent['meta_keywords'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">

            <div class="card-header">
                <h5>Banner</h5>
            </div>

            <div class="card-body">

                <div class="row">
                    {{-- <div class="col">
                <div class="card w-100 border position-relative overflow-hidden">
                    <div class="card-body p-4">
                      <div class="text-center">
                       <div class="file_choose_icon">
                          <img src="{{ get_site_image_src('images', !empty($sitecontent['image1']) ? $sitecontent['image1'] : "") }}" alt="matdash-img" class="img-fluid " >
                       </div>
                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        <input class="form-control uploadFile" name="image1" type="file"
                            data-bs-original-title="" title="">
                      </div>
                    </div>
                  </div>
            </div> --}}

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="banner_heading">Heading</label>
                                    <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                        placeholder=""
                                        value="{{ !empty($sitecontent['banner_heading']) ? $sitecontent['banner_heading'] : '' }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="banner_text">Text</label>
                                    <textarea id="banner_text" name="banner_text" rows="4" class="editor">{{ !empty($sitecontent['banner_text']) ? $sitecontent['banner_text'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
        <div class="card">

            <div class="card-header">
                <h5>Section 1</h5>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_heading1">Heading</label>
                                    <input class="form-control" id="section1_heading1" type="text"
                                        name="section1_heading1" placeholder=""
                                        value="{{ !empty($sitecontent['section1_heading1']) ? $sitecontent['section1_heading1'] : '' }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_txt1"> Text</label>
                                    <textarea id="section1_txt1" name="section1_txt1" rows="4" class="editor">{{ !empty($sitecontent['section1_txt1']) ? $sitecontent['section1_txt1'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_side_br_price">Price Heading</label>
                                    <input class="form-control" id="section1_side_br_price" type="text"
                                        name="section1_side_br_price" placeholder=""
                                        value="{{ !empty($sitecontent['section1_side_br_price']) ? $sitecontent['section1_side_br_price'] : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_side_br_price_sub">Price Sub Heading</label>
                                    <input class="form-control" id="section1_side_br_price_sub" type="text"
                                        name="section1_side_br_price_sub" placeholder=""
                                        value="{{ !empty($sitecontent['section1_side_br_price_sub']) ? $sitecontent['section1_side_br_price_sub'] : '' }}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_txt2"> Side Bar Text</label>
                                    <textarea id="section1_txt2" name="section1_txt2" rows="4" class="editor">{{ !empty($sitecontent['section1_txt2']) ? $sitecontent['section1_txt2'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="sec1_link_text">Link Text</label>
                                    <input class="form-control" id="sec1_link_text" type="text" name="sec1_link_text"
                                        placeholder=""
                                        value="{{ !empty($sitecontent['sec1_link_text']) ? $sitecontent['sec1_link_text'] : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="sec1_link_url">Link URL</label>
                                    <select name="sec1_link_url" class="form-control" required>
                                        @foreach ($all_pages as $key => $page)
                                            <option value="{{ $key }}"
                                                {{ !empty($sitecontent['sec1_link_url']) && $sitecontent['sec1_link_url'] == $key ? 'selected' : '' }}>
                                                {{ $page }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header">
                <h5>Section 2</h5>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section2_heading">Heading</label>
                            <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                placeholder=""
                                value="{{ !empty($sitecontent['section2_heading']) ? $sitecontent['section2_heading'] : '' }}">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section2_txt1"> Text 1</label>
                            <textarea id="section2_txt1" name="section2_txt1" rows="4" class="editor">{{ !empty($sitecontent['section2_txt1']) ? $sitecontent['section2_txt1'] : '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card w-100 border position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="file_choose_icon">
                                        <img src="{{ get_site_image_src('images', !empty($sitecontent['image1']) ? $sitecontent['image1'] : '') }}"
                                            alt="matdash-img" class="img-fluid ">
                                    </div>
                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    <input class="form-control uploadFile" name="image1" type="file"
                                        data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section2_txt2">Text 2</label>
                                    <textarea id="section2_txt2" name="section2_txt2" rows="4" class=" editor">{{ !empty($sitecontent['section2_txt2']) ? $sitecontent['section2_txt2'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="sec2_link_text">Link Text</label>
                            <input class="form-control" id="sec2_link_text" type="text" name="sec2_link_text"
                                placeholder=""
                                value="{{ !empty($sitecontent['sec2_link_text']) ? $sitecontent['sec2_link_text'] : '' }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="sec2_link_url">Link URL</label>
                            <select name="sec2_link_url" class="form-control" required>
                                @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['sec2_link_url']) && $sitecontent['sec2_link_url'] == $key ? 'selected' : '' }}>
                                        {{ $page }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Section 3</h5>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section3_heading">Heading</label>
                            <input class="form-control" id="section3_heading" type="text" name="section3_heading"
                                placeholder=""
                                value="{{ !empty($sitecontent['section3_heading']) ? $sitecontent['section3_heading'] : '' }}">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section3_txt"> Text</label>
                            <textarea id="section3_txt" name="section3_txt" rows="4" class="editor">{{ !empty($sitecontent['section3_txt']) ? $sitecontent['section3_txt'] : '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="sec3_link_text">Link Text</label>
                            <input class="form-control" id="sec3_link_text" type="text" name="sec3_link_text"
                                placeholder=""
                                value="{{ !empty($sitecontent['sec3_link_text']) ? $sitecontent['sec3_link_text'] : '' }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="sec3_link_url">Link URL</label>
                            <select name="sec3_link_url" class="form-control" required>
                                @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['sec3_link_url']) && $sitecontent['sec3_link_url'] == $key ? 'selected' : '' }}>
                                        {{ $page }}</option>
                                @endforeach
                            </select>
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
