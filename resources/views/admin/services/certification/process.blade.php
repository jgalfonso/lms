@extends('admin.template')

@section('title', 'Process')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Process</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
         <div class="col-lg-12">
            <a href="#" class="btn btn-success" type="button" data-toggle="modal" data-target="#assessModal" style="width: 100px;">Moderate</a>
            <a href="#t" class="btn btn-danger" type="button" style="width: 100px;">Cancel</a>
        </div>

        <div class="col-lg-12" style="margin-top: 15px;">
            <div class="card">
                <div class="header">
                    <h2>Basic Information  <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                </div>

                <div class="body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <table style="width: 100%">
                                         <tr>
                                            <td>Class Code / Name:</td>
                                            <td style="width:80%">: <b>J0427QM52Z</b></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>: <a href="">Google IT Support Professional Certificate</a></td>
                                        </tr>
                                        <tr>
                                            <td>Course</b></td>
                                            <td>: Information Technology</td>
                                        </tr>

                                        <tr>
                                            <td>Instructor</td>
                                            <td>: Susie Willis</td>
                                        </tr>
                                        <tr>
                                            <td>Schedule</td>
                                            <td>: MWF</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body"  style="margin-top: 15px;">
                    <div class="row">
                        <div class="col-lg-12">
                              <table style="width: 100%">
                                <tr>
                                    <td>Assessor</b></td>
                                    <td style="width:80%">: Marshall Nichols</td>
                                </tr>

                                <tr>
                                    <td>Assesssment Date</td>
                                    <td>: 03 Feb 2021</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#trainees">Trainees</a></li>
                        <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#moderations">Moderations</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="tab-content mt-0">
                <div class="tab-pane show active" id="trainees">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive" style="margin-top: 10px;">
                                    <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%;">Student No.</th>
                                                <th>Name of Trainee</th>
                                                <th style="width: 10%">Certification No.</th>
                                                <th style="width: 10%">Registration No.</th>
                                                <th style="width: 10%">Status</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td>S1000000001</td>
                                                <td><a href="">Marshall Nichols</a><br>marshall-n@gmail.com</td>
                                                <td>CT-000000001</td>
                                                <td>RG-000000001</td>
                                                <td>Passed</td>
                                                <td class="align-center">
                                                    <a  href="" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <tr>

                                                  <td>S1000000002</td>
                                                    <td><a href="">Debra Stewart</a><br>debra@gmail.com</td>
                                                 <td>CT-000000002</td>
                                                 <td>RG-000000002</td>
                                                 <td>Passed</td>
                                                 <td class="align-center">
                                                    <a  href="" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>

                                            <tr>

                                                  <td>S1000000003</td>
                                                <td><a href="">Erin Gonzales</a><br>erinonzales@gmail.com</td>
                                                 <td>CT-000000003</td>
                                                 <td>RG-000000003</td>
                                                 <td>Passed</td>
                                                  <td class="align-center">
                                                    <a  href="" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
                </div>

                <div class="tab-pane" id="moderations">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" style="margin-top: 15px;">

                                <div class="body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Date Process:</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input id="invoice-date" data-date-autoclose="true" class="form-control" data-date-format="dd-mm-yyyy" required data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-invoice-date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8"> </div>

                                        <div class="col-lg-12">
                                            <label>Grade:</label>
                                             <div class="form-group">


                                                <div class="fancy-checkbox" style="float:left">
                                                    <label><input type="checkbox"><span>For QA</span></label>
                                                </div>

                                                <div class="fancy-checkbox" style="float:left">
                                                    <label><input type="checkbox"><span>For Approval</span></label>
                                                </div>

                                                <div class="fancy-checkbox" style="float:left">
                                                    <label><input type="checkbox"><span>Approved</span></label>
                                                </div>

                                                <div class="fancy-checkbox" style="float:left">
                                                    <label><input type="checkbox"><span>Published</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" style="margin-top: 15px;">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea id="billing-address" class="form-control" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
                <div class="action-btn" style="padding-bottom: 3%;">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#assessModal" style="width: 100px">Moderate</button>
                    <a href="javascript:history.back()" class="btn btn-danger" style="width: 100px">Cancel</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="assessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p>Are you sure you want to moderate this record?</p>
                        <div class="form-group">
                            <label>Valid For</label>
                            <select class="form-control">
                                <option selected="">Choose...</option>
                                <option>2 years</option>
                                <option>3 years</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="width: 100px;">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100px;" >Cancel</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/certification/process.js') }}"></script>
@endsection
