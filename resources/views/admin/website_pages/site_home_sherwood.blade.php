@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    {!! breadcrumb('Sherwood Home Page') !!}
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
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="banner_heading">Heading</label>
                                    <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                        placeholder=""
                                        value="{{ !empty($sitecontent['banner_heading']) ? $sitecontent['banner_heading'] : '' }}">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="banner_text">Text</label>
                                <textarea id="banner_text" name="banner_text" rows="4" class=" editor">{{ !empty($sitecontent['banner_text']) ? $sitecontent['banner_text'] : '' }}</textarea>
                            </div>
                        </div> --}}
                        {{-- here is button --}}

                    </div>
                    {{-- <div class="row">
                        <?php $how_works = 0; ?>
                        @for ($i = 1; $i <= 3; $i++)
                            <?php $how_works = $how_works + 1; ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Block {{ $how_works }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-4">
                                                    <label class="form-label"
                                                        for="banner_heading{{ $i }}">Heading
                                                        {{ $how_works }}</label>
                                                    <input class="form-control" id="banner_heading{{ $i }}"
                                                        type="text" name="banner_heading{{ $i }}"
                                                        placeholder=""
                                                        value="{{ !empty($sitecontent['banner_heading' . $i]) ? $sitecontent['banner_heading' . $i] : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-4">
                                                    <label class="form-label" for="banner_text{{ $i }}">Text
                                                        {{ $how_works }}</label>
                                                    <input class="form-control" id="banner_text{{ $i }}"
                                                        type="text" name="banner_text{{ $i }}"
                                                        placeholder=""
                                                        value="{{ !empty($sitecontent['banner_text' . $i]) ? $sitecontent['banner_text' . $i] : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- banner End --}}


        {{-- section1 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 1 </h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-6">
                        <div class="card w-100 border position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="file_choose_icon">
                                        <img src="{{ get_site_image_src('images', !empty($sitecontent['image2']) ? $sitecontent['image2'] : '') }}"
                                            alt="matdash-img" class="img-fluid ">
                                    </div>
                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    <input class="form-control uploadFile" name="image2" type="file"
                                        data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="mb-3">
                            <label class="form-label" for="section1_heading">Heading 1</label>
                            <input class="form-control" id="section1_heading1" type="text" name="section1_heading1"
                                placeholder=""
                                value="{{ !empty($sitecontent['section1_heading1']) ? $sitecontent['section1_heading1'] : '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section1_text1">Text 1</label>
                            <textarea id="section1_text1" name="section1_text1" rows="4" class=" editor">{{ !empty($sitecontent['section1_text1']) ? $sitecontent['section1_text1'] : '' }}</textarea>
                        </div>
                    </div>

                    <hr>
                    <br>
                    <br>
                    <br>

                    <div class="col-6">

                        <div class="mb-3">
                            <label class="form-label" for="section1_heading2">Heading 2</label>
                            <input class="form-control" id="section1_heading2" type="text" name="section1_heading2"
                                placeholder=""
                                value="{{ !empty($sitecontent['section1_heading2']) ? $sitecontent['section1_heading2'] : '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section1_text2">Text 2</label>
                            <textarea id="section1_text2" name="section1_text2" rows="4" class=" editor">{{ !empty($sitecontent['section1_text2']) ? $sitecontent['section1_text2'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card w-100 border position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="file_choose_icon">
                                        <img src="{{ get_site_image_src('images', !empty($sitecontent['image3']) ? $sitecontent['image3'] : '') }}"
                                            alt="matdash-img" class="img-fluid ">
                                    </div>
                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    <input class="form-control uploadFile" name="image3" type="file"
                                        data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_btn_txt">Button Text</label>
                                    <input class="form-control" id="section1_btn_txt" type="text"
                                        name="section1_btn_txt" placeholder=""
                                        value="{{ $sitecontent['section1_btn_txt'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_btn_link">Button Link URL</label>
                                    <input type="text" class="form-control" name="section1_btn_link"
                                        id="section1_btn_link" value="{{ $sitecontent['section1_btn_link'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- section2 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 2</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $counter = 0; ?>
                    @for ($i = 1; $i <= 5; $i++)
                        <?php $counter = $counter + 1; ?>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label" for="section2_heading{{ $i }}">Heading
                                    {{ $counter }}</label>
                                <input class="form-control" id="section2_heading{{ $i }}" type="text"
                                    name="section2_heading{{ $i }}" placeholder=""
                                    value="{{ !empty($sitecontent['section2_heading' . $i]) ? $sitecontent['section2_heading' . $i] : '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="section2_text{{ $i }}">text
                                    {{ $counter }}</label>
                                <input class="form-control" id="section2_text{{ $i }}" type="text"
                                    name="section2_text{{ $i }}" placeholder=""
                                    value="{{ !empty($sitecontent['section2_text' . $i]) ? $sitecontent['section2_text' . $i] : '' }}">
                            </div>
                        </div>
                    @endfor


                </div>
            </div>
        </div>
        {{-- section2 End --}}


        {{-- section3 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 3</h5>
            </div>
            <div class="card-body">
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
                                    <input class="form-control" id="section3_text" type="text" name="section3_text"
                                        placeholder="" value="{{ $sitecontent['section3_text'] ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section3_btn_txt">Button Text</label>
                                    <input class="form-control" id="section3_btn_txt" type="text"
                                        name="section3_btn_txt" placeholder=""
                                        value="{{ $sitecontent['section3_btn_txt'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section3_btn_link">Button Link URL</label>
                                    <input type="text" class="form-control" name="section3_btn_link"
                                        id="section3_btn_link" value="{{ $sitecontent['section3_btn_link'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- section3 end --}}


        {{-- section4 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 4</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section4_heading">Heading</label>
                                            <input class="form-control" id="section4_heading" type="text"
                                                name="section4_heading" placeholder=""
                                                value="{{ $sitecontent['section4_heading'] ?? '' }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="section4_text">Text</label>
                                            <input class="form-control" id="section4_text" type="text"
                                                name="section4_text" placeholder=""
                                                value="{{ $sitecontent['section4_text'] ?? '' }}">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <?php $how_works = 0; ?>
                                    @for ($i = 4; $i <= 6; $i++)
                                        <?php $how_works = $how_works + 1; ?>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Block {{ $how_works }}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6>Image {{ $how_works }}</h6>
                                                            <div
                                                                class="card w-100 border position-relative overflow-hidden">

                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <div class="file_choose_icon">
                                                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image' . $i]) ? $sitecontent['image' . $i] : '') }}"
                                                                                alt="matdash-img" class="img-fluid ">
                                                                        </div>
                                                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size
                                                                            of 800K</p>
                                                                        <input class="form-control uploadFile"
                                                                            name="image{{ $i }}"
                                                                            type="file" data-bs-original-title=""
                                                                            title="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label class="form-label"
                                                                    for="section4_heading{{ $i }}">Heading
                                                                    {{ $how_works }}</label>
                                                                <input class="form-control"
                                                                    id="section4_heading{{ $i }}"
                                                                    type="text"
                                                                    name="section4_heading{{ $i }}"
                                                                    placeholder=""
                                                                    value="{{ !empty($sitecontent['section4_heading' . $i]) ? $sitecontent['section4_heading' . $i] : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-4">
                                                                <label class="form-label"
                                                                    for="section4_text{{ $i }}">Text
                                                                    {{ $how_works }}</label>
                                                                <input class="form-control"
                                                                    id="section4_text{{ $i }}" type="text"
                                                                    name="section4_text{{ $i }}"
                                                                    placeholder=""
                                                                    value="{{ !empty($sitecontent['section4_text' . $i]) ? $sitecontent['section4_text' . $i] : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-4">
                                                                <label class="form-label"
                                                                    for="section4_btn_link{{ $i }}">Button Link
                                                                    {{ $how_works }}</label>
                                                                <input class="form-control"
                                                                    id="section4_btn_link{{ $i }}"
                                                                    type="text"
                                                                    name="section4_btn_link{{ $i }}"
                                                                    placeholder=""
                                                                    value="{{ !empty($sitecontent['section4_btn_link' . $i]) ? $sitecontent['section4_btn_link' . $i] : '' }}">
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
        {{-- section4 end --}}


        {{-- section5 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 5</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card w-100 border position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <div class="file_choose_icon">
                                        <img src="{{ get_site_image_src('images', !empty($sitecontent['image7']) ? $sitecontent['image7'] : '') }}"
                                            alt="matdash-img" class="img-fluid ">
                                    </div>
                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    <input class="form-control uploadFile" name="image7" type="file"
                                        data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- section5 End --}}


        {{-- section6 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 6</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="section6_heading">Heading</label>
                            <input class="form-control" id="section6_heading" type="text" name="section6_heading"
                                placeholder="" value="{{ $sitecontent['section6_heading'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="section6_text">Text</label>
                            <textarea id="section6_text" name="section6_text" rows="4" class=" editor">{{ !empty($sitecontent['section6_text']) ? $sitecontent['section6_text'] : '' }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <h6>Image 1</h6>
                                        <div class="text-center">
                                            <div class="file_choose_icon">
                                                <img src="{{ get_site_image_src('images', !empty($sitecontent['image8']) ? $sitecontent['image8'] : '') }}"
                                                    alt="matdash-img" class="img-fluid ">
                                            </div>
                                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            <input class="form-control uploadFile" name="image8" type="file"
                                                data-bs-original-title="" title="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <h6>Image 2</h6>
                                        <div class="text-center">
                                            <div class="file_choose_icon">
                                                <img src="{{ get_site_image_src('images', !empty($sitecontent['image9']) ? $sitecontent['image9'] : '') }}"
                                                    alt="matdash-img" class="img-fluid ">
                                            </div>
                                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            <input class="form-control uploadFile" name="image9" type="file"
                                                data-bs-original-title="" title="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php $how_works = 0; ?>
                            @for ($i = 10; $i <= 12; $i++)
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
                                                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
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
                                                            for="section6_heading{{ $i }}">Heading
                                                            {{ $how_works }}</label>
                                                        <input class="form-control"
                                                            id="section6_heading{{ $i }}" type="text"
                                                            name="section6_heading{{ $i }}" placeholder=""
                                                            value="{{ !empty($sitecontent['section6_heading' . $i]) ? $sitecontent['section6_heading' . $i] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-4">
                                                        <label class="form-label"
                                                            for="section6_numeric{{ $i }}">Numeric
                                                            {{ $how_works }}</label>
                                                        <input class="form-control"
                                                            id="section6_numeric{{ $i }}" type="text"
                                                            name="section6_numeric{{ $i }}" placeholder=""
                                                            value="{{ !empty($sitecontent['section6_numeric' . $i]) ? $sitecontent['section6_numeric' . $i] : '' }}">
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
        {{-- section6 End --}}



        {{-- section7 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section7 - Gallery Section</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section7_heading">Heading</label>
                                            <input class="form-control" id="section7_heading" type="text"
                                                name="section7_heading" placeholder=""
                                                value="{{ $sitecontent['section7_heading'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section7_title">Title</label>
                                            <input class="form-control" id="section7_title" type="text"
                                                name="section7_title" placeholder=""
                                                value="{{ $sitecontent['section7_title'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        {{-- section7 End --}}
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                <button class="btn btn-primary" type="submit">Update Page</button>
            </div>
        </div>
    @endsection
