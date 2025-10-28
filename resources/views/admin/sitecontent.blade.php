@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content="{{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    {!! breadcrumb('Website Pages') !!}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap align-middle dataTable basic-datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Page Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td width="65%">Home</td>
                                <td>
                                    <a href="{{ url('admin/pages/home') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td width="65%">About</td>
                                <td>
                                    <a href="{{ url('admin/pages/about') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>

                            <tr>
                                <td>2.2</td>
                                <td width="65%" style="color:red">Sherwood Page</td>
                                <td>
                                    <a href="{{ url('admin/pages/sherwoodhome') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td width="65%">Services</td>
                                <td>
                                    <a href="{{ url('admin/pages/services') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td width="65%">Service Detail</td>
                                <td>
                                    <a href="{{ url('admin/pages/services_detail') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td width="65%">Projects</td>
                                <td>
                                    <a href="{{ url('admin/pages/projects') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td width="65%">Project Detail</td>
                                <td>
                                    <a href="{{ url('admin/pages/project_detail') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td width="65%">Contact Us</td>
                                <td>
                                    <a href="{{ url('admin/pages/contact') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td width="65%">Impact</td>
                                <td>
                                    <a href="{{ url('admin/pages/impact') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td width="65%">Case Study</td>
                                <td>
                                    <a href="{{ url('admin/pages/caseStudy') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td width="65%">Case Study Details</td>
                                <td>
                                    <a href="{{ url('admin/pages/caseStudyDetail') }}" class="btn btn-primary active">Edit
                                        Page</a>
                                </td>
                            </tr>

                            {{-- <tr>
                            <td>10</td>
                            <td width="65%">Terms & Conditions</td>
                            <td>
                                <a href="{{ url('admin/pages/terms') }}" class="btn btn-primary active">Edit
                                    Page</a>
                            </td>
                        </tr>

                        <tr>
                            <td>11</td>
                            <td width="65%">Privacy Policy</td>
                            <td>
                                <a href="{{ url('admin/pages/privacy_policy') }}" class="btn btn-primary active">Edit
                                    Page</a>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td width="65%">Request Consultation</td>
                            <td>
                                <a href="{{ url('admin/pages/request') }}" class="btn btn-primary active">Edit
                                    Page</a>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td width="65%">Our Providers</td>
                            <td>
                                <a href="{{ url('admin/pages/our_providers') }}" class="btn btn-primary active">Edit
                                    Page</a>
                            </td>
                        </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
