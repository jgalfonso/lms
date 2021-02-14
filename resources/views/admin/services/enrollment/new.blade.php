@extends('admin.template')

@section('title', 'Enrollment')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Enrollment</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" style="margin-bottom: 15px;">
                <div class="header">
                    <h2>Student Information <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                </div>

                <div class="body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="/admin/assets/images/avatar.jpg" class="avtar-pic" alt="Avatar" style="width: 100%;">
                            </div>

                            <div class="col-md-10">
                                <table style="width: 100%">
                                    <tr>
                                        <td  style="width:20%"><b>Name</b> </td>
                                        <td>: <a href="">Marshall Nichols</a></td>
                                    </tr>

                                    <tr>
                                        <td style="width:20%"><b>Student No.</b></td>
                                        <td >: S1000000001</td>
                                    </tr>

                                    <tr>
                                        <td style="width:20%"><b>Email</b></td>
                                        <td >: marshall-n@gmail.com</td>
                                    </tr>

                                    <tr>
                                        <td style="width:2  0%"><b>Dob</b></td>
                                        <td >: 21 October 1990</td>
                                    </tr>

                                    <tr>
                                        <td style="width:2  0%"><b>Age</b></td>
                                        <td >: 30</td>
                                    </tr>

                                    <tr>
                                        <td style="width:2  0%"><b>Gender</b></td>
                                        <td >: Female</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">

                <div class="header">
                    <h2>Classes Enrolled  <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>

                </div>


                <div class="table-responsive">
                    <table id="dt" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Course</th>
                                <th>Instructor</th>
                                <th>Schedule</th>
                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>XOPSDDEEE</b><br/><a href="">Key Technologies for Business Specialization</a></td>
                                <td>Information Technology</td>
                                <td>Susie Willis</td>
                                <td>MWF</td>
                                <td class="align-center">
                                    <button type="button" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip" data-placement="top"> <i class="icon-trash"></i> </button>
                                </td>
                            </tr>
                            <tr>
                                <td><b>B2O6W788D8</b><br/><a href="">Data Engineering Foundations Specialization</a></td>
                                <td>Information Technology</td>
                                <td>Francisco Vasquez</td>
                                <td>TTH</td>
                                <td class="align-center">
                                    <button type="button" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip" data-placement="top"> <i class="icon-trash"></i> </button>
                                </td>
                            </tr>
                            <tr>
                                <td><b>J0427QM52Z</b><br/><a href="">Google IT Support Professional Certificate</a></td>
                                <td>Information Technology</td>
                                <td>Peter Smith</td>
                                <td>MWF</td>
                                <td class="align-center">
                                    <button type="button" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip" data-placement="top"> <i class="icon-trash"></i> </button>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                     <button type="button" class="btn btn-default float-right"  data-toggle="modal" data-target="#addClass">Add Class</button>
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
                       <button type="submit" class="btn btn-success" style="width: 100px">Enroll</button>
                       <a href="javascript:history.back()" class="btn btn-secondary" style="width: 100px">Cancel</a>
                   </div>
               </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="max-width: 900px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding: 20px 0 20px 0">
                    <div class="col-lg-12">
                        <div class="row">
                             <div class="col-lg-6 col-md-4 col-sm-6">
                                <label>Name / Class No:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-6 text-right">
                                 <label>&nbsp;</label>
                                <a href="javascript:void(0);" class="btn btn-primary btn-block" title="" style="width: 100px">Search</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table id="dt" class="table table-hover table-striped js-basic-example dataTable table-custom spacing5 mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 1%; background: #f6f7f9 !important;" class="text-center"> <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span style="width: 1px;"></span></label>
                                        </div></th>
                                    <th  style="background: #f6f7f9 !important;">Class</th>
                                    <th  style="background: #f6f7f9 !important;">Course</th>
                                    <th  style="background: #f6f7f9 !important;">Instructor</th>
                                    <th  style="background: #f6f7f9 !important;">Schedule</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center" style="background: #f6f7f9 !important;">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span style="width: 1px;"></span></label>
                                        </div>
                                    </td>
                                    <td style="background: #f6f7f9 !important;"><b>XOPSDDEEE</b><br/><a href="">Key Technologies for Business Specialization</a></td>
                                    <td style="background: #f6f7f9 !important;">Information Technology</td>
                                    <td style="background: #f6f7f9 !important;">John Doe</td>
                                    <td style="background: #f6f7f9 !important;">MWF</td>
                                </tr>
                                <tr>
                                     <td class="text-center" style="background: #f6f7f9 !important;">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span style="width: 1px;"></span></label>
                                        </div>
                                    </td>
                                    <td style="background: #f6f7f9 !important;"><b>B2O6W788D8</b><br/><a href="">Data Engineering Foundations Specialization</a></td>
                                    <td style="background: #f6f7f9 !important;">Information Technology</td>
                                    <td style="background: #f6f7f9 !important;">John Smith</td>
                                    <td style="background: #f6f7f9 !important;">TTH</td>
                                </tr>
                                <tr>
                                     <td class="text-center" style="background: #f6f7f9 !important;">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span style="width: 1px;"></span></label>
                                        </div>
                                    </td>
                                    <td style="background: #f6f7f9 !important;"><b>J0427QM52Z</b><br/><a href="">Google IT Support Professional Certificate</a></td>
                                    <td style="background: #f6f7f9 !important;">Information Technology</td>
                                    <td style="background: #f6f7f9   !important;">Peter Smith</td>
                                    <td style="background: #f6f7f9 !important;">MWF</td>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                     </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="width: 100px;">Add</button>

                    <button type="button" data-dismiss="modal" class="btn btn-default" style="width: 100px;">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/assessment/new.js') }}"></script>
@endsection
