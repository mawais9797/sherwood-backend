@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')


<div class="card">
  <div class="card-body pb-0" data-simplebar="">
    <div class="row flex-nowrap flex_wrap_responsive">

      <div class="col">
        <div class="card bg-gradient-success">
          <div class="card-body text-center px-9 pb-4">
            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto display-6">
              <iconify-icon icon="tabler:message-user"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1">Total Contact Messages</h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
              {{$contact}}
            </h4>
            <a href="{{url('/admin/contact')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">View
              Details</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card warning-gradient bg-gradient-primary">
          <div class="card-body text-center px-9 pb-4">
            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-info flex-shrink-0 mb-3 mx-auto display-6">
              <iconify-icon icon="jam:newsletter"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1">Total Subscribers</h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
              {{$subscribers}}
            </h4>
            <a href="{{url('/admin/subscribers')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">View
              Details</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card warning-gradient bg-gradient-purple">
          <div class="card-body text-center px-9 pb-4">
            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto display-6">
              <iconify-icon icon="jam:newsletter"></iconify-icon>
            </div>
            <h6 class="fw-normal fs-3 mb-1">Total FAQs</h6>
            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
              {{$faq_count}}
            </h4>
            <a href="{{url('/admin/subscribers')}}" class="btn btn-white fs-2 fw-semibold text-nowrap">View
              Details</a>
          </div>
        </div>
      </div>




    </div>
  </div>
</div>

</div>
</div>
@endsection