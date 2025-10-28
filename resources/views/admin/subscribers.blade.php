@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')

    <div class="page-body" id="dashboard">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-9">
                        <h3>Subscribers</h3>
                    </div>
                    <div class="col-3 text-right">
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Base styles-->
                <div class="col-sm-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success dark" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger dark" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display dataTable" id="advance-1">
                                    <thead>
                                        <tr>
                                            <th width="5%">Sr#</th>
                                            <th width="">Email</th>
                                            <th width="15%">Status</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($rows))
                                            @foreach ($rows as $key => $row)
                                                <tr class="odd">
                                                    <td class="sorting_1">{{ $key + 1 }}</td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{!! getReadStatus($row->status) !!}</td>
                                                    <td class="action">
                                                        <a href="{{ url('admin/subscribers/delete/' . $row->id) }}"
                                                            class="badge badge-danger"
                                                            onclick="return confirm('Are you sure?');">
                                                            <i data-feather="trash-2"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="odd">
                                                <td colspan="6">No record(s) found!</td>
                                            </tr>
                                        @endif



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
