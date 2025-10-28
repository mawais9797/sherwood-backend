@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('Story Page') !!}

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
                                value="{{ $sitecontent['page_title'] ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="meta_title">Meta Title</label>
                            <input class="form-control" id="meta_title" type="text" name="meta_title" placeholder=""
                                value="{{ $sitecontent['meta_title'] ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="site_meta_desc">Meta Description</label>
                            <textarea class="form-control" id="meta_description" rows="3" name="meta_description">{{ $sitecontent['meta_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" id="meta_keywords" rows="3" name="meta_keywords">{{ $sitecontent['meta_keywords'] ?? '' }}</textarea>
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
                <div class="col-md-12">


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_heading">Banner Heading</label>
                                <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                    placeholder="" value="{{ $sitecontent['banner_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_text">Text</label>
                                <textarea id="banner_text" name="banner_text" rows="4" class="editor">{{ $sitecontent['banner_text'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_btn_txt">Button Text</label>
                                <input class="form-control" id="banner_btn_txt" type="text"
                                    name="banner_btn_txt" placeholder=""
                                    value="{{ $sitecontent['banner_btn_txt'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_btn_link">Button Link URL</label>
                                <select name="banner_btn_link" class="form-control" required>
                                    <option value="">Set URL</option>

                                    @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['banner_btn_link']) && $sitecontent['banner_btn_link'] == $key ? 'selected' : '' }}>
                                        {{ $page }}
                                    </option>
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
            <h5>Section 1 (Our Mission) </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_heading">Heading</label>
                                <input class="form-control" id="section1_heading" type="text"
                                    name="section1_heading" placeholder=""
                                    value="{{ $sitecontent['section1_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_text">Text</label>
                                <textarea id="section1_text" name="section1_text" rows="4" class=" editor">{{ !empty($sitecontent['section1_text']) ? $sitecontent['section1_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec1_title1">Title 1</label>
                                <input class="form-control" id="sec1_title1" type="text"
                                    name="sec1_title1" placeholder=""
                                    value="{{ $sitecontent['sec1_title1'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="sec1_title2">Title 2</label>
                                <input class="form-control" id="sec1_title2" type="text"
                                    name="sec1_title2" placeholder=""
                                    value="{{ $sitecontent['sec1_title2'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="short_desc1">Description 1</label>
                                <textarea id="short_desc1" name="short_desc1" rows="4" class=" editor">{{ !empty($sitecontent['short_desc1']) ? $sitecontent['short_desc1'] : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="short_desc2">Description 2</label>
                                <textarea id="short_desc2" name="short_desc2" rows="4" class=" editor">{{ !empty($sitecontent['short_desc2']) ? $sitecontent['short_desc2'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>


    <div class="card">

        <div class="card-header">
            <h5>Section 2 (Our Journey) </h5>
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
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section2_text">Text</label>
                                        <textarea id="section2_text" name="section2_text" rows="4" class=" editor">{{ !empty($sitecontent['section2_text']) ? $sitecontent['section2_text'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <?php $our_journey = 0; ?>
                                @for ($i = 1; $i <= 3; $i++)
                                    <?php $our_journey = $our_journey + 1; ?>
                                    <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Block {{ $our_journey }}</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-4">
                                                        <label class="form-label"
                                                            for="sec1_heading{{ $i }}">Heading
                                                            {{ $our_journey }}</label>
                                                        <input class="form-control" id="sec1_heading{{ $i }}"
                                                            type="text" name="sec1_heading{{ $i }}"
                                                            placeholder=""
                                                            value="{{ !empty($sitecontent['sec1_heading' . $i]) ? $sitecontent['sec1_heading' . $i] : '' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="sec1_text{{ $i }}">Text
                                                            {{ $our_journey }}</label>
                                                        <textarea id="sec1_text{{ $i }}" name="sec1_text{{ $i }}" rows="8" class="form-control">{{ !empty($sitecontent['sec1_text' . $i]) ? $sitecontent['sec1_text' . $i] : "" }}</textarea>
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

    <div class="card">

        <div class="card-header">
            <h5>Section 3 (Core Values)</h5>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section3_heading">Heading</label>
                                        <input class="form-control" id="section3_heading" type="text"
                                            name="section3_heading" placeholder=""
                                            value="{{ $sitecontent['section3_heading'] ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section3_text">Text</label>
                                        <textarea id="section3_text" name="section3_text" rows="4" class=" editor">{{ !empty($sitecontent['section3_text']) ? $sitecontent['section3_text'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section3_points">Key Points</label>
                                        <textarea id="section3_points" name="section3_points" rows="4" class=" editor">{{ !empty($sitecontent['section3_points']) ? $sitecontent['section3_points'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section3_btn_txt">Button 1 Text</label>
                                        <input class="form-control" id="section3_btn_txt" type="text"
                                            name="section3_btn_txt" placeholder=""
                                            value="{{ $sitecontent['section3_btn_txt'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section3_btn_link">Button Link URL</label>
                                        <select name="section3_btn_link" class="form-control" required>
                                            <option value="">Set URL</option>

                                            @foreach ($all_pages as $key => $page)
                                            <option value="{{ $key }}"
                                                {{ !empty($sitecontent['section3_btn_link']) && $sitecontent['section3_btn_link'] == $key ? 'selected' : '' }}>
                                                {{ $page }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="card">
        <div class="card-header">
            <h5>Section 4 </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="image2"> Image</label>
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="file_choose_icon">
                                                    <img src="{{ get_site_image_src('images', !empty($sitecontent['image2']) ? $sitecontent['image2'] : " ") }}" alt="matdash-img" class="img-fluid ">
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                <input class="form-control uploadFile" name="image2" type="file"
                                                    data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section4_heading">Heading</label>
                                        <input class="form-control" id="section4_heading" type="text"
                                            name="section4_heading" placeholder=""
                                            value="{{ $sitecontent['section4_heading'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section4_text">Text</label>
                                        <textarea id="section4_text" name="section4_text" rows="4" class=" editor">{{ !empty($sitecontent['section4_text']) ? $sitecontent['section4_text'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section4_btn_txt">Button 1 Text</label>
                                        <input class="form-control" id="section4_btn_txt" type="text"
                                            name="section4_btn_txt" placeholder=""
                                            value="{{ $sitecontent['section4_btn_txt'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section4_btn_link">Button Link URL</label>
                                        <select name="section4_btn_link" class="form-control" required>
                                            <option value="">Set URL</option>

                                            @foreach ($all_pages as $key => $page)
                                            <option value="{{ $key }}"
                                                {{ !empty($sitecontent['section4_btn_link']) && $sitecontent['section4_btn_link'] == $key ? 'selected' : '' }}>
                                                {{ $page }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h5>Section (FAQ,s)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="faq_heading">Heading</label>
                                        <input class="form-control" id="faq_heading" type="text"
                                            name="faq_heading" placeholder=""
                                            value="{{ $sitecontent['faq_heading'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h5>Section (Request A Consultation)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="common_heading">Heading</label>
                                        <input class="form-control" id="common_heading" type="text"
                                            name="common_heading" placeholder=""
                                            value="{{ $sitecontent['common_heading'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="common_text">Text</label>
                                <textarea id="common_text" name="common_text" rows="4" class=" editor">{{ !empty($sitecontent['common_text']) ? $sitecontent['common_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="common_btn_txt">Button Text</label>
                                <input class="form-control" id="common_btn_txt" type="text"
                                    name="common_btn_txt" placeholder=""
                                    value="{{ $sitecontent['common_btn_txt'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="common_btn_link">Button Link URL</label>
                                <select name="common_btn_link" class="form-control" required>
                                    <option value="">Set URL</option>

                                    @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['common_btn_link']) && $sitecontent['common_btn_link'] == $key ? 'selected' : '' }}>
                                        {{ $page }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <h6>You can edit CTA section from edit CTA section on mange pages</h6>

                </div>
            </div>
        </div>


    </div> -->


    <div class="col-12">
        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
            <button class="btn btn-primary" type="submit">Update Page</button>
        </div>
    </div>

    @endsection