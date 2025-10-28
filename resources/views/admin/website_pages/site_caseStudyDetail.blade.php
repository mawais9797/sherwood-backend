@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    {!! breadcrumb('Case Study Detail Page') !!}
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
                <h5>Section1</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_title">Title</label>
                                    <input class="form-control" id="section1_title" type="text" name="section1_title"
                                        placeholder=""
                                        value="{{ !empty($sitecontent['section1_title']) ? $sitecontent['section1_title'] : '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_heading">Heading</label>
                                    <input class="form-control" id="section1_heading" type="text"
                                        name="section1_heading" placeholder=""
                                        value="{{ !empty($sitecontent['section1_heading']) ? $sitecontent['section1_heading'] : '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_text">Text</label>
                                    <textarea id="section1_text" name="section1_text" rows="4" class=" editor">{{ !empty($sitecontent['section1_text']) ? $sitecontent['section1_text'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- row repeater --}}
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 newTable" id="newTable">
                        <thead class="header-item">
                            <tr>
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
                                $sec1s = getMultiText('caseStudyDetail-section1');
                            @endphp
                            @if (countlength($sec1s) > 0)
                                @php
                                    $sec1s_count = 1;
                                @endphp
                                @foreach ($sec1s as $sec1)
                                    <tr class="search-items">
                                        <td>
                                            <input type="text" name="sec1_title[]" id="sec1_title"
                                                value="<?= $sec1->title ?>" class="form-control" placeholder="Text">
                                        </td>
                                        <td>
                                            <textarea name="sec1_txt1[]" id="sec_txt5" class="form-control" rows="3"><?= $sec1->txt1 ?></textarea>
                                        </td>
                                        <td>
                                            <input type="number" name="sec1_order_no[]" id="sec1_order_no"
                                                value="<?= $sec1->order_no ?>" class="form-control" placeholder="Order#"
                                                required>
                                        </td>
                                        <td>
                                            <div class="action-btn">
                                                @if ($sec1s_count >= 1)
                                                    <a href="javascript:void(0)" class="text-primary edit delNewRowTbl"
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
                                        <input type="text" name="sec1_title[]" id="sec1_title" value=""
                                            class="form-control" placeholder="Text">
                                    </td>
                                    <td>
                                        <textarea name="sec1_txt1[]" id="sec_txt5" class="form-control" rows="3"></textarea>
                                    </td>
                                    <td>
                                        <input type="number" name="sec1_order_no[]" id="sec1_order_no" value=""
                                            class="form-control" placeholder="Order#" required>
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
        {{-- section2 --}}
        <div class="card">
            <div class="card-header">
                <h5>Section2 (CTA)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section2_title">Title</label>
                                    <input class="form-control" id="section2_title" type="text" name="section2_title"
                                        placeholder=""
                                        value="{{ !empty($sitecontent['section2_title']) ? $sitecontent['section2_title'] : '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="section2_heading">Heading</label>
                                    <input class="form-control" id="section2_heading" type="text"
                                        name="section2_heading" placeholder=""
                                        value="{{ !empty($sitecontent['section2_heading']) ? $sitecontent['section2_heading'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="section2_text">Text</label>
                                <textarea id="section2_text" name="section2_text" rows="4" class=" editor">{{ !empty($sitecontent['section2_text']) ? $sitecontent['section2_text'] : '' }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section2_btn_txt">Button Text</label>
                                    <input class="form-control" id="section2_btn_txt" type="text"
                                        name="section2_btn_txt" placeholder=""
                                        value="{{ $sitecontent['section2_btn_txt'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="section2_btn_link">Button Link URL</label>
                                    <input type="text" class="form-control" name="section2_btn_link"
                                        id="section2_btn_link" value="{{ $sitecontent['section2_btn_link'] ?? '' }}">
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
