@extends('admin.template')

@section('title', 'Assessment')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Assessment</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right">
	    <a href="{{ url('admin/services/assessment/new') }}" class="btn btn-new btn-sm btn-primary" title="New Assessment">New Assessment</a>
	</div>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card card-search">
                <div class="header">
                    <h2>Filter</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-lg-10 col-md-6">
                            <label>Name / Class No.</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 col-md-6">
                            <div class="input-group">
                                <input id="search" type="text" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <button id="search" type="button" class="btn btn-sm btn-info btn-block btn-search">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                        <thead>
                            <tr>
                                <th>Class No.</th>
                                <th>Class Name</th>
                                <th>Name of Trainee</th>
                                <th>Assessment Date</th>
                                <th>Status</th>
                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A-001</td>
                                <td>Class 1</td>
                                <td>John De La</td>
                                <td>01/01/2021</td>
                                <td>Active</td>
                                <td class="align-center">
                                    <a  href="services-assessment-view_assessment.html" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>A-002</td>
                                <td>Class 1</td>
                                <td>John De La</td>
                                <td>01/01/2021</td>
                                <td>Expired</td>
                                <td class="align-center">
                                    <a  href="services-assessment-view_assessment.html" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <ul class="pagination mt-2" style="float: right;" >
                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/projects/archives.js') }}"></script>
@endsection
