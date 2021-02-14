@extends('admin.template')

@section('title', 'Assessment')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Assessment</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div id="alert"></div>
	<div class="row clearfix">
        <div class="col-lg-12">
            <form id="new" method="post" novalidate>
                <div class="card">
                    <div class="header">
                        <h2>Basic Information</h2>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class No.</label>
                                    <select class="form-control">
                                        <option selected="">Choose...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-8"></div>

                            <div class="col-md-5">
                                <table style="width: 100%">
                                    <tr>
                                        <td><b>Name:</b> </td>
                                        <td style="width:50%">Juan De La</td>
                                    </tr>
                                    <tr>
                                        <td><b>Course:</b></td>
                                        <td style="width:50%"></td>
                                    </tr>

                                    <tr>
                                        <td><b>Instructor:</b></td>
                                        <td style="width:50%"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Schedule:</b></td>
                                        <td style="width:50%"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Student Enrolled:</b></td>
                                        <td style="width:50%"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td style="width:50%"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-7"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>Assessment Details </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="dt" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                            <thead>
                                <tr>
                                    <th>Name of Trainee</th>
                                    <th class="text-center">Passed</th>
                                    <th class="text-center">Failed</th>
                                    <th class="text-center">Incomplete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kevin Love</td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>John Simon</td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>John Peter</td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
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

                    <div class="row"  style="float: left; margin-top:  10px">
                       <div class="col-md-12">
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assessModal" style="width: 100px">Assess</button>
                       </div>
                   </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/assessment/new.js') }}"></script>
@endsection
