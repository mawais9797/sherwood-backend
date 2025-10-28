@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!!breadcrumb('Price Sensitivity Report Page')!!}
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
    <div class="card">

        <div class="card-header">
            <h5>Banner</h5>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col">
                    <div class="card w-100 border position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="file_choose_icon">
                                    <img src="{{ get_site_image_src('images', !empty($sitecontent['image1']) ? $sitecontent['image1'] : "") }}" alt="matdash-img" class="img-fluid ">
                                </div>
                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                <input class="form-control uploadFile" name="image1" type="file" data-bs-original-title="" title="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col">
                            <div>
                                <label class="form-label" for="banner_title">Banner Title</label>
                                <input class="form-control" id="banner_title" type="text" name="banner_title" placeholder="" value="{{ !empty($sitecontent['banner_title']) ? $sitecontent['banner_title'] : "" }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_text">Banner Text</label>
                                <textarea id="banner_text" name="banner_text" rows="4" class="editor">{{ !empty($sitecontent['banner_text']) ? $sitecontent['banner_text'] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <div class="card">

        <div class="card-header">
            <h5>Section 1 (Features)</h5>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_heading"> Heading</label>
                                <input class="form-control" id="section1_heading" type="text" name="section1_heading" placeholder="" value="{{ !empty($sitecontent['section1_heading']) ? $sitecontent['section1_heading'] : "" }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_text">Text</label>
                                <textarea id="section1_text" name="section1_text" rows="4" class="editor">{{ !empty($sitecontent['section1_text']) ? $sitecontent['section1_text'] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_btn_text"> Button Text</label>
                                <input class="form-control" id="section1_btn_text" type="text" name="section1_btn_text" placeholder="" value="{{ !empty($sitecontent['section1_btn_text']) ? $sitecontent['section1_btn_text'] : "" }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_btn_link"> Button Link</label>
                                <input class="form-control" id="section1_btn_link" type="text" name="section1_btn_link" placeholder="" value="{{ !empty($sitecontent['section1_btn_link']) ? $sitecontent['section1_btn_link'] : "" }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <?php $features = 0; ?>
        @for ($i = 2; $i <= 5; $i++) <?php $features = $features + 1; ?> <div class="col-lg-6">
            <div class="card">

                <div class="card-header">
                    <h5>Block {{ $features }}</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image' . $i]) ? $sitecontent['image' . $i] : '') }}" alt="matdash-img" class="img-fluid ">
                                        </div>
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        <input class="form-control uploadFile" name="image{{ $i }}" type="file" data-bs-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec1_heading{{ $i }}">Heading
                                    {{ $features }}</label>
                                <input class="form-control" id="sec1_heading{{ $i }}" type="text" name="sec1_heading{{ $i }}" placeholder="" value="{{ !empty($sitecontent['sec1_heading' . $i]) ? $sitecontent['sec1_heading' . $i] : "" }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec1_text{{ $i }}">Text
                                    {{ $features }}</label>
                                <textarea id="sec1_text{{ $i }}" name="sec1_text{{ $i }}" rows="8" class="form-control">{{ !empty($sitecontent['sec1_text' . $i]) ? $sitecontent['sec1_text' . $i] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endfor



    <div class="card">
        <div class="card-header">
            <h5>Section 2 (How it works)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_heading"> Heading</label>
                                <input class="form-control" id="section2_heading" type="text" name="section2_heading" placeholder="" value="{{ !empty($sitecontent['section2_heading']) ? $sitecontent['section2_heading'] : "" }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_text">Text</label>
                                <textarea id="section2_text" name="section2_text" rows="4" class="editor">{{ !empty($sitecontent['section2_text']) ? $sitecontent['section2_text'] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <?php $how_work = 0; ?>
        @for ($i = 6; $i <= 8; $i++) <?php $how_work = $how_work + 1; ?> <div class="col-lg-4">
            <div class="card">

                <div class="card-header">
                    <h5>Block {{ $how_work }}</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image' . $i]) ? $sitecontent['image' . $i] : '') }}" alt="matdash-img" class="img-fluid ">
                                        </div>
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        <input class="form-control uploadFile" name="image{{ $i }}" type="file" data-bs-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec2_heading{{ $i }}">Heading
                                    {{ $how_work }}</label>
                                <input class="form-control" id="sec2_heading{{ $i }}" type="text" name="sec2_heading{{ $i }}" placeholder="" value="{{ !empty($sitecontent['sec2_heading' . $i]) ? $sitecontent['sec2_heading' . $i] : "" }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec2_text{{ $i }}">Text
                                    {{ $how_work }}</label>
                                <textarea id="sec2_text{{ $i }}" name="sec2_text{{ $i }}" rows="8" class="form-control">{{ !empty($sitecontent['sec2_text' . $i]) ? $sitecontent['sec2_text' . $i] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endfor




    <div class="card">
        <div class="card-header">
            <h5>Section 3(Pricing)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_heading"> Heading</label>
                                <input class="form-control" id="section3_heading" type="text" name="section3_heading" placeholder="" value="{{ !empty($sitecontent['section3_heading']) ? $sitecontent['section3_heading'] : "" }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_text">Text</label>
                                <textarea id="section3_text" name="section3_text" rows="4" class="editor">{{ !empty($sitecontent['section3_text']) ? $sitecontent['section3_text'] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_btn_text_1"> Button 1 Text</label>
                                <input class="form-control" id="section3_btn_text_1" type="text" name="section3_btn_text_1" placeholder="" value="{{ !empty($sitecontent['section3_btn_text_1']) ? $sitecontent['section3_btn_text_1'] : "" }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_btn_link_1"> Button 1 Link</label>
                                <input class="form-control" id="section3_btn_link_1" type="text" name="section3_btn_link_1" placeholder="" value="{{ !empty($sitecontent['section3_btn_link_1']) ? $sitecontent['section3_btn_link_1'] : "" }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_btn_text_2"> Button 2 Text</label>
                                <input class="form-control" id="section3_btn_text_2" type="text" name="section3_btn_text_2" placeholder="" value="{{ !empty($sitecontent['section3_btn_text_2']) ? $sitecontent['section3_btn_text_2'] : "" }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_btn_link_2"> Button 2 Link</label>
                                <input class="form-control" id="section3_btn_link_2" type="text" name="section3_btn_link_2" placeholder="" value="{{ !empty($sitecontent['section3_btn_link_2']) ? $sitecontent['section3_btn_link_2'] : "" }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="card">
        <div class="card-header">
            <h5>Section 4 (Benefits)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_heading"> Heading</label>
                                <input class="form-control" id="section4_heading" type="text" name="section4_heading" placeholder="" value="{{ !empty($sitecontent['section4_heading']) ? $sitecontent['section4_heading'] : "" }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_text">Text</label>
                                <textarea id="section4_text" name="section4_text" rows="4" class="editor">{{ !empty($sitecontent['section4_text']) ? $sitecontent['section4_text'] : "" }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <?php $benefits = 0; ?>
        @for ($i = 1; $i <= 3; $i++) <?php $benefits = $benefits + 1; ?> <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Benefit {{ $benefits }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec4_heading{{ $i }}">Heading
                                    {{ $benefits }}</label>
                                <input class="form-control" id="sec4_heading{{ $i }}" type="text" name="sec4_heading{{ $i }}" placeholder="" value="{{ !empty($sitecontent['sec4_heading' . $i]) ? $sitecontent['sec4_heading' . $i] : "" }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec4_text{{ $i }}">Text
                                    {{ $benefits }}</label>
                                <textarea id="sec4_text{{ $i }}" name="sec4_text{{ $i }}" rows="8" class="form-control">{{ !empty($sitecontent['sec4_text' . $i]) ? $sitecontent['sec4_text' . $i] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endfor


    <div class="card">
        <div class="card-header">
            <h5>Signup Section</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="signup_heading"> Heading</label>
                                <input class="form-control" id="signup_heading" type="text" name="signup_heading" placeholder="" value="{{ !empty($sitecontent['signup_heading']) ? $sitecontent['signup_heading'] : "" }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="signup_text">Text</label>
                                <textarea id="signup_text" name="signup_text" rows="4" class="editor">{{ !empty($sitecontent['signup_text']) ? $sitecontent['signup_text'] : "" }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="signup_btn_text"> Button Text</label>
                                <input class="form-control" id="signup_btn_text" type="text" name="signup_btn_text" placeholder="" value="{{ !empty($sitecontent['signup_btn_text']) ? $sitecontent['signup_btn_text'] : "" }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="signup_btn_link"> Button Link</label>
                                <input class="form-control" id="signup_btn_link" type="text" name="signup_btn_link" placeholder="" value="{{ !empty($sitecontent['signup_btn_link']) ? $sitecontent['signup_btn_link'] : "" }}">
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