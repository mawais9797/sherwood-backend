@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    {!! breadcrumb('Advanced Peptides Page') !!}
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
                                <div class="mb-3">
                                    <label class="form-label" for="banner_title">Banner Title</label>
                                    <input class="form-control" id="banner_title" type="text" name="banner_title"
                                        placeholder="" value="{{ $sitecontent['banner_title'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="banner_heading">Heading</label>
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
                                    <label class="form-label" for="section1_title">Title</label>
                                    <input class="form-control" id="section1_title" type="text" name="section1_title"
                                        placeholder="" value="{{ $sitecontent['section1_title'] ?? '' }}">
                                </div>
                            </div>
                        </div>
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
                        {{-- row repeater --}}
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 newTable" id="newTable">
                                <thead class="header-item">
                                    <tr>
                                        <th width="10%">Image/ Icon</th>
                                        <th>Heading</th>
                                        <th>Text</th>
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
                                        $sec1s = getMultiText('project-section1');
                                    @endphp
                                    @if (countlength($sec1s) > 0)
                                        @php
                                            $sec1s_count = 1;
                                        @endphp
                                        @foreach ($sec1s as $sec1)
                                            <tr class="search-items">
                                                <td>
                                                    <div class="d-flex align-items-center" id="imgDiv">
                                                        <input type="file" name="sec1_image[]" accept="image/*"
                                                            id="newImgInput" style="display: none;" />
                                                        <img src="{{ get_site_image_src('images', !empty($sec1->image) ? $sec1->image : '') }}"
                                                            alt="avatar" class=""
                                                            style="width: 100%; cursor: pointer;background:#ddd"
                                                            id="newImg">
                                                        <input type="hidden" name="sec1_pics[]"
                                                            value="<?= $sec1->image ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="sec1_title[]" id="sec1_title"
                                                        value="<?= $sec1->title ?>" class="form-control"
                                                        placeholder="Text">
                                                </td>
                                                <td>
                                                    <textarea name="sec1_txt1[]" id="sec_txt5" class="form-control" rows="3"><?= $sec1->txt1 ?></textarea>
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
                                                                class="text-primary edit delNewRowTbl" id="delNewRowTbl">
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
                                                <div class="d-flex align-items-center" id="imgDiv">
                                                    <input type="file" name="sec1_image[]" accept="image/*"
                                                        id="newImgInput" style="display: none;" />
                                                    <img src="{{ asset('/images/no-image.svg') }}" alt="avatar"
                                                        style="width: 100%; cursor: pointer;background:#ddd"
                                                        id="newImg">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="sec1_title[]" id="sec1_title" value=""
                                                    class="form-control" placeholder="Text">
                                            </td>
                                            <td>
                                                <textarea name="sec1_txt1[]" id="sec_txt5" class="form-control" rows="3"></textarea>
                                            </td>
                                            <td>
                                                <input type="number" name="sec1_order_no[]" id="sec1_order_no"
                                                    value="" class="form-control" placeholder="Order#" required>
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
        {{-- section2 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 2 (Tool and Technology)</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_title"> Title</label>
                                <input class="form-control" id="section2_title" type="text" name="section2_title"
                                    placeholder=""
                                    value="{{ !empty($sitecontent['section2_title']) ? $sitecontent['section2_title'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_heading"> Heading</label>
                                <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                    placeholder=""
                                    value="{{ !empty($sitecontent['section2_heading']) ? $sitecontent['section2_heading'] : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- row repeater --}}
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Technology & Tool</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 newTable" id="newTable" isCkeditor='true'>
                                    <thead class="header-item">
                                        <tr>
                                            <th>Heading</th>
                                            <th width="55%">Text</th>
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
                                            $sec1s = getMultiText('technology-section');
                                        @endphp
                                        @if (countlength($sec1s) > 0)
                                            @php
                                                $sec1s_count = 1;
                                            @endphp
                                            @foreach ($sec1s as $sec1)
                                                <tr class="search-items">
                                                    <td>
                                                        <input type="text" name="sec2_title[]" id="sec2_title"
                                                            value="<?= $sec1->title ?>" class="form-control"
                                                            placeholder="Text">
                                                    </td>
                                                    <td>
                                                        <textarea id="sec2_txt_{{ $sec1s_count }}" name="sec2_txt1[]" rows="3" class="ckeditor">{{ !empty($sec1->txt1) ? $sec1->txt1 : '' }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="sec2_order_no[]" id="sec2_order_no"
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
                                                    <input type="text" name="sec2_title[]" id="sec3_title"
                                                        value="" class="form-control" placeholder="Text">
                                                </td>
                                                <td>
                                                    <textarea id="sec2_txt_0" name="sec2_txt1[]" rows="3" class="ckeditor"></textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="sec2_order_no[]" id="sec2_order_no"
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
        {{-- section3 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section 3 (FAQ)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section3_title">Title</label>
                                    <input class="form-control" id="section3_title" type="text" name="section3_title"
                                        placeholder="" value="{{ $sitecontent['section3_title'] ?? '' }}">
                                </div>
                            </div>
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
                    </div>
                </div>
            </div>
            {{-- row repeater --}}
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add FAQ</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 newTable" id="newTable">
                                    <thead class="header-item">
                                        <tr>
                                            <th>Question</th>
                                            <th width="55%">Answer</th>
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
                                            $sec1s = getMultiText('faq-section');
                                        @endphp
                                        @if (countlength($sec1s) > 0)
                                            @php
                                                $sec1s_count = 1;
                                            @endphp
                                            @foreach ($sec1s as $sec1)
                                                <tr class="search-items">
                                                    <td>
                                                        <input type="text" name="sec3_title[]" id="sec3_title"
                                                            value="<?= $sec1->title ?>" class="form-control"
                                                            placeholder="Text">
                                                    </td>
                                                    <td>
                                                        <textarea id="sec3_txt_{{ $sec1s_count }}" name="sec3_txt1[]" rows="3" class="form-control">{{ !empty($sec1->txt1) ? $sec1->txt1 : '' }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="sec3_order_no[]" id="sec3_order_no"
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
                                                    <input type="text" name="sec3_title[]" id="sec3_title"
                                                        value="" class="form-control" placeholder="Text">
                                                </td>
                                                <td>
                                                    <textarea id="sec3_txt_0" name="sec3_txt1[]" rows="3" class="form-control"></textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="sec3_order_no[]" id="sec3_order_no"
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
        </div>
        {{-- section 4 --}}
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
                                    <label class="form-label" for="section4_btn_txt">Button Text</label>
                                    <input class="form-control" id="section4_btn_txt" type="text"
                                        name="section4_btn_txt" placeholder=""
                                        value="{{ $sitecontent['section4_btn_txt'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section4_btn_link">Button Link URL</label>
                                    <input type="text" class="form-control" name="section4_btn_link"
                                        id="section4_btn_link" value="{{ $sitecontent['section4_btn_link'] ?? '' }}">
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
