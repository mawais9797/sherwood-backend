@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('About Page') !!}
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
    {{-- banner --}}
    <div class="card">
        <div class="card-header">
            <h5>Banner</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div>
                                <label class="form-label" for="banner_title">Banner Title</label>
                                <input class="form-control" id="banner_title" type="text" name="banner_title"
                                    placeholder=""
                                    value="{{ !empty($sitecontent['banner_title']) ? $sitecontent['banner_title'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>
                                <label class="form-label" for="banner_heading">Banner Heading</label>
                                <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                    placeholder=""
                                    value="{{ !empty($sitecontent['banner_heading']) ? $sitecontent['banner_heading'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_text">Banner Text</label>
                                <textarea id="banner_text" name="banner_text" rows="4" class="editor">{{ !empty($sitecontent['banner_text']) ? $sitecontent['banner_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end banner --}}
    {{-- section1 --}}
    <div class="card">
        <div class="card-header">
            <h5>Section1</h5>
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
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_text">Text</label>
                                <textarea id="section1_text" name="section1_text" rows="4" class="editor">{{ !empty($sitecontent['section1_text']) ? $sitecontent['section1_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_text1">Quote Text</label>
                                <textarea id="section1_text1" name="section1_text1" rows="4" class="editor">{{ !empty($sitecontent['section1_text1']) ? $sitecontent['section1_text1'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
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
    {{-- section1 End --}}
    {{-- section2 --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 2</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_title">Title</label>
                                <input class="form-control" id="section1_title" type="text" name="section1_title"
                                    placeholder=""
                                    value="{{ !empty($sitecontent['section1_title']) ? $sitecontent['section1_title'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_heading"> Heading</label>
                                <input class="form-control" id="section1_heading" type="text"
                                    name="section1_heading" placeholder=""
                                    value="{{ !empty($sitecontent['section1_heading']) ? $sitecontent['section1_heading'] : '' }}">
                            </div>
                        </div>
                    </div>
                    {{-- here --}}
                    <div class="row">
                        <?php $how_works = 0; ?>
                        @for ($i = 2; $i <= 6; $i++)
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
                                                    for="section1_heading{{ $i }}">Heading
                                                    {{ $how_works }}</label>
                                                <input class="form-control"
                                                    id="section1_heading{{ $i }}" type="text"
                                                    name="section1_heading{{ $i }}" placeholder=""
                                                    value="{{ !empty($sitecontent['section1_heading' . $i]) ? $sitecontent['section1_heading' . $i] : '' }}">
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
    {{-- section2 end --}}
    {{-- section3 --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 3 (TimeLine)</h5>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section3_heading"> Heading</label>
                            <input class="form-control" id="section3_heading" type="text" name="section3_heading"
                                placeholder=""
                                value="{{ !empty($sitecontent['section3_heading']) ? $sitecontent['section3_heading'] : '' }}">
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
            </div>
        </div>
        {{-- route Petter --}}
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>TimeLine</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 newTable" id="newTable" isCkeditor='true'>
                                <thead class="header-item">
                                    <tr>
                                        <th width="25%">Heading</th>
                                        <th width="60%">Text</th>
                                        <th width="12%">Order No.</th>
                                        <th width="5%">
                                            <div class="action-btn">
                                                <a href="javascript:void(0)" class="text-primary edit addNewRowTbl"
                                                    id="addNewRowTbl">
                                                    <i class="ti ti-plus fs-6 fw-bold"></i>
                                                </a>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- start row -->
                                    @php
                                    $sec1s = getMultiText('timeline-section');
                                    @endphp
                                    @if (countlength($sec1s) > 0)
                                    @php
                                    $sec1s_count = 1;
                                    @endphp
                                    @foreach ($sec1s as $sec1)
                                    <tr class="search-items">
                                        <td>
                                            <input type="text" name="sec1_title[]" id="sec1_title"
                                                value="<?= $sec1->title ?>" class="form-control"
                                                placeholder="Text">
                                        </td>
                                        <td>
                                            <textarea name="sec1_txt1[]" id="sec_txt5" class="ckeditor" rows="3"><?= $sec1->txt1 ?></textarea>
                                        </td>
                                        <td>
                                            <input type="number" name="sec1_order_no[]" id="sec1_order_no"
                                                value="<?= $sec1->order_no ?>" class="form-control"
                                                placeholder="Order#" required>
                                        </td>
                                        <td>
                                            <div class="action-btn">
                                                @if ($sec1s_count >= 1)
                                                <a href="javascript:void(0)"
                                                    class="text-primary edit delNewRowTbl"
                                                    id="delNewRowTbl">
                                                    <i class="ti ti-minus fs-5"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                    $sec1s_count++;
                                    @endphp
                                    @endforeach
                                    @else
                                    <tr class="search-items">
                                        <td>
                                            <input type="text" name="sec1_title[]" id="sec1_title"
                                                value="" class="form-control" placeholder="Text">
                                        </td>
                                        <td>
                                            <textarea name="sec1_txt1[]" id="sec_txt5" class="ckeditor" rows="3"></textarea>
                                        </td>
                                        <td>
                                            <input type="number" name="sec1_order_no[]" id="sec1_order_no"
                                                value="" class="form-control" placeholder="Order#"
                                                required>
                                        </td>
                                        <td>
                                            <div class="action-btn">
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    <!-- end row -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
    </div>
    {{-- section3 end --}}
    {{-- section4 --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 4</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <h4>Left side</h4>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_left_heading"> Heading</label>
                                <input class="form-control" id="section3_left_heading" type="text"
                                    name="section3_left_heading" placeholder=""
                                    value="{{ !empty($sitecontent['section3_left_heading']) ? $sitecontent['section3_left_heading'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_left_text">Text</label>
                                <textarea id="section3_left_text" name="section3_left_text" rows="4" class="editor">{{ !empty($sitecontent['section3_left_text']) ? $sitecontent['section3_left_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <h4>Right side</h4>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_right_heading"> Heading</label>
                                <input class="form-control" id="section3_right_heading" type="text"
                                    name="section3_right_heading" placeholder=""
                                    value="{{ !empty($sitecontent['section3_right_heading']) ? $sitecontent['section3_right_heading'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_right_text">Text</label>
                                <textarea id="section3_right_text" name="section3_right_text" rows="4" class="editor">{{ !empty($sitecontent['section3_right_text']) ? $sitecontent['section3_right_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Section 4 Down</h5>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section4_down_heading"> Heading</label>
                            <input class="form-control" id="section4_down_heading" type="text"
                                name="section4_down_heading" placeholder=""
                                value="{{ !empty($sitecontent['section4_down_heading']) ? $sitecontent['section4_down_heading'] : '' }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section4_btn_text"> Button Text</label>
                            <input class="form-control" id="section4_btn_text" type="text"
                                name="section4_btn_text" placeholder=""
                                value="{{ !empty($sitecontent['section4_btn_text']) ? $sitecontent['section4_btn_text'] : '' }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="section4_btn_link"> Button Link</label>
                            <input class="form-control" id="section4_btn_link" type="text"
                                name="section4_btn_link" placeholder=""
                                value="{{ !empty($sitecontent['section4_btn_link']) ? $sitecontent['section4_btn_link'] : '' }}">
                        </div>
                    </div>
                    <div class="row">
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
                                                    for="section4_heading{{ $i }}">Heading
                                                    {{ $how_works }}</label>
                                                <input class="form-control"
                                                    id="section4_heading{{ $i }}" type="text"
                                                    name="section4_heading{{ $i }}" placeholder=""
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
                                                <input class="form-control" id="section4_text{{ $i }}"
                                                    type="text" name="section4_text{{ $i }}"
                                                    placeholder=""
                                                    value="{{ !empty($sitecontent['section4_text' . $i]) ? $sitecontent['section4_text' . $i] : '' }}">
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
    <div class="card">
        <div class="card-header">
            <h5>Section 5</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_title">Title</label>
                                <input class="form-control" id="section5_title" type="text" name="section5_title"
                                    placeholder=""
                                    value="{{ !empty($sitecontent['section5_title']) ? $sitecontent['section5_title'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_heading"> Heading</label>
                                <input class="form-control" id="section5_heading" type="text"
                                    name="section5_heading" placeholder=""
                                    value="{{ !empty($sitecontent['section5_heading']) ? $sitecontent['section5_heading'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_text">Text</label>
                                <textarea id="section5_text" name="section5_text" rows="4" class="editor">{{ !empty($sitecontent['section5_text']) ? $sitecontent['section5_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_btn_text"> Button Text</label>
                                <input class="form-control" id="section5_btn_text" type="text"
                                    name="section5_btn_text" placeholder=""
                                    value="{{ !empty($sitecontent['section5_btn_text']) ? $sitecontent['section5_btn_text'] : '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_btn_link"> Button Link</label>
                                <input class="form-control" id="section5_btn_link" type="text"
                                    name="section5_btn_link" placeholder=""
                                    value="{{ !empty($sitecontent['section5_btn_link']) ? $sitecontent['section5_btn_link'] : '' }}">
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