@extends('admin.template')

@section('title', 'Assessment')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

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
    <form id="new" method="post" novalidate>
    	<div class="row clearfix">
            <div class="col-lg-12">

                <div class="card">
                    <div class="header">
                        <h2>Basic Information</h2>
                    </div>

                    <div class="body">
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class:</label>
                                    <select class="form-control" id="class_id" name="class_id">
                                        <option selected="">Choose...</option>

                                        @foreach ($classes as $row)
                                            <option value="{{ $row->class_id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="body" style="margin-top: 15px;">
                        <div class="row">
                            <div class="col-md-12">
                                <table style="width: 100%">
                                    <tr>
                                        <td>Class Code / Name</td>
                                        <td style="width:80%" id="class_code">:</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td id="class_name">:</td>
                                    </tr>
                                    <tr>
                                        <td>Course</b></td>
                                        <td id="course_name">:</td>
                                    </tr>

                                    <tr>
                                        <td>Instructor</td>
                                        <td id="instructor">:</td>
                                    </tr>
                                    <tr>
                                        <td>Schedule</td>
                                        <td id="schedule">: </td>
                                    </tr>
                                    <tr>
                                        <td>No. of Trainees</td>
                                        <td id="no_trainees">:</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td id="class_status">:</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-7"></div>
                        </div>
                    </div>

                    <div class="body" style="margin-top: 15px;">
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Assessment Date:</label>
                                    <div class="input-group mb-3 inputDiv">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input id="assess_date" name="assessment_date" data-date-autoclose="true" class="form-control date" data-date-format="dd-mm-yyyy" required data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-invoice-date">
                                    </div>
                                    <p id="error-invoice-date"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="header">
                        <h2>Assessment Details </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="trainees" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="width: 15%;">Control No.</th>
                                    <th>Name of Trainee</th>
                                    <th class="text-center" style="width: 15%">Passed</th>
                                    <th class="text-center" style="width: 15%">Failed</th>
                                    <th class="text-center" style="width: 15%">Incomplete</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row"  style="float: left; margin-top: -35px">
                       <div class="col-md-12">
                           <button type="button" class="btn btn-success" id="assess" style="width: 100px">Assess</button>
                           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#assessModal" style="width: 100px">Cancel</button>
                       </div>
                   </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="assessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="    max-width: 600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding: 15px;">
                        <div class="row">
                            <div  class="col-lg-12" style="margin-bottom: 15px;">
                                <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                            </div>

                            <div class="col-lg-3">

                            </div>

                            <div class="col-lg-3 text-center">
                                 <label>Prefix</label>
                            </div>

                            <div class="col-lg-3 text-center">
                                 <label>Series</label>
                            </div>

                            <div class="col-lg-3 text-center">
                                 <label>Suffix</label>
                            </div>

                            <div class="col-lg-3  text-right" style="padding-right: 0;">
                                <div class="form-group">
                                    <label style="margin-top: 6px;"><b>Certificate No:</b></label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                     <input name="cert-prefix" type="text" class="form-control" >
                                 </div>
                             </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                     <input name="cert-series" type="text" class="form-control" >
                                 </div>
                             </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                     <input name="cert-suffix" type="text" class="form-control" >
                                 </div>
                             </div>


                             <div class="col-lg-3 text-right" style="padding-right: 0;">
                                <div class="form-group">
                                    <label style="margin-top: 6px;"><b>Registration No:</b></label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                     <input name="reg-prefix" type="text" class="form-control" >
                                 </div>
                             </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                     <input name="reg-series" type="text" class="form-control" >
                                 </div>
                             </div>

                              <div class="col-lg-3">
                                 <div class="form-group">
                                     <input name="reg-suffix" type="text" class="form-control" >
                                 </div>
                             </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save"  style="width: 100px;">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"  style="width: 100px;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/assessment/new.js') }}"></script>
@endsection
