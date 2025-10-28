@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    {!! breadcrumb('Services Details Page') !!}
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
        {{-- section1 --}}
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
                                    <label class="form-label" for="section1_heading">Heading</label>
                                    <input class="form-control" id="section1_heading" type="text" name="section1_heading"
                                        placeholder="" value="{{ $sitecontent['section1_heading'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php $how_works = 0; ?>
                            @for ($i = 1; $i <= 4; $i++)
                                <?php $how_works = $how_works + 1; ?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Block {{ $how_works }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-4">
                                                        <label class="form-label"
                                                            for="section1_heading{{ $i }}">Heading
                                                            {{ $how_works }}</label>
                                                        <input class="form-control"
                                                            id="section1_heading{{ $i }}" type="text"
                                                            name="section1_heading{{ $i }}" placeholder=""
                                                            value="{{ !empty($sitecontent['section1_heading' . $i]) ? $sitecontent['section1_heading' . $i] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-4">
                                                        <label class="form-label"
                                                            for="section1_text{{ $i }}">Text
                                                            {{ $how_works }}</label>
                                                        <textarea class="form-control" id="section1_text{{ $i }}" name="section1_text{{ $i }}"
                                                            placeholder="">{{ !empty($sitecontent['section1_text' . $i]) ? $sitecontent['section1_text' . $i] : '' }}</textarea>
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
        {{-- section2 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section2</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section2_title">Title</label>
                                            <input class="form-control" id="section2_title" type="text"
                                                name="section2_title" placeholder=""
                                                value="{{ $sitecontent['section2_title'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- section3 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 3</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php $how_works = 0; ?>
                            @for ($i = 1; $i <= 4; $i++)
                                <?php $how_works = $how_works + 1; ?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Block {{ $how_works }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-4">
                                                        <label class="form-label"
                                                            for="section3_heading{{ $i }}">Heading
                                                            {{ $how_works }}</label>
                                                        <input class="form-control"
                                                            id="section3_heading{{ $i }}" type="text"
                                                            name="section3_heading{{ $i }}" placeholder=""
                                                            value="{{ !empty($sitecontent['section3_heading' . $i]) ? $sitecontent['section3_heading' . $i] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-4">
                                                        <label class="form-label"
                                                            for="section3_text{{ $i }}">Text
                                                            {{ $how_works }}</label>
                                                        <textarea class="form-control" id="section3_text{{ $i }}" name="section3_text{{ $i }}"
                                                            placeholder="">{{ !empty($sitecontent['section3_text' . $i]) ? $sitecontent['section3_text' . $i] : '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
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
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="section3_text">Text</label>
                                <textarea id="section3_text" name="section3_text" rows="4" class=" editor">{{ !empty($sitecontent['section3_text']) ? $sitecontent['section3_text'] : '' }}</textarea>
                            </div>
                        </div>
                        {{-- here is button --}}
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
        {{-- section4 --}}
        {{-- section2 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section4</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section4_title">Title</label>
                                            <input class="form-control" id="section4_title" type="text"
                                                name="section4_title" placeholder=""
                                                value="{{ $sitecontent['section4_title'] ?? '' }}">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- section5 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section5</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section5_title">Title</label>
                                            <input class="form-control" id="section5_title" type="text"
                                                name="section5_title" placeholder=""
                                                value="{{ $sitecontent['section5_title'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section5_heading">Heading</label>
                                            <input class="form-control" id="section5_heading" type="text"
                                                name="section5_heading" placeholder=""
                                                value="{{ $sitecontent['section5_heading'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section5_text">Text</label>
                                    <textarea id="section5_text" name="section5_text" rows="4" class=" editor">{{ !empty($sitecontent['section5_text']) ? $sitecontent['section5_text'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section5_btn_txt">Button Text</label>
                                    <input class="form-control" id="section5_btn_txt" type="text"
                                        name="section5_btn_txt" placeholder=""
                                        value="{{ $sitecontent['section5_btn_txt'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section5_btn_link">Button Link URL</label>
                                    <input type="text" class="form-control" name="section5_btn_link"
                                        id="section5_btn_link" value="{{ $sitecontent['section5_btn_link'] ?? '' }}">
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
