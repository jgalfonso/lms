@extends('admin.template')

@section('title', 'Services - Enrollment (Enroll Student)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Enroll Student</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right hidden-xs">
        <a href="/admin/manage-users/students/new" class="btn btn-sm btn-primary" title="" style="width: 100px">Add New</a>
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div class="col-md-12">
            <div class="card" style="margin-bottom: 15px;">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <label>Name / Student No:</label>
                            <div class="input-group">
                                <input id="key" type="text" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 text-right">
                            <label>&nbsp;</label>
                            <button id="search" type="button" class="btn btn-sm btn-info btn-block" style="width: 100px">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dt" class="table dataTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width: 1%;"></th>
                            <th>Name</th>
                            <th style="width: 10%;">Faculty No.</th>
                            <th style="width: 10%;">Dob</th>
                            <th style="width: 10%;">Age</th>
                            <th style="width: 10%;">Gender</th>
                            <th style="width: 1%;"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/enrollment/index.js') }}"></script>
@endsection
