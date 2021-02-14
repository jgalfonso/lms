@extends('admin.template')

@section('title', 'Class Summary')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Class Summary</h1>

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
            <div class="card" style="margin-bottom: 10px;">
                <div class="body">
                    <ul class="accordion2" style="border: 0;">
                        <li class="accordion-item" style="border: 0;">
                            <h3 class="accordion-thumb"><span>Filter</span></h3>
                            <div class="accordion-panel" style="display: none;">
                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6">
                                        <label>Name / Class No.</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Status</label>
                                        <select class="form-control">
                                            <option value="" selected>Select...</option>
                                            <option value="">Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6">
                                        <label>Name / Student No.</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                    </div>

                                    <div class="col-lg-3">
                                        <label>Schedule</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="date_closed" >
                                        </div>
                                         <span class="help-block">Start Date</span>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>&nbsp;</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="date_closed" >
                                        </div>
                                         <span class="help-block">End Date</span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6">
                                        <label>Course</label>
                                        <select class="form-control">
                                            <option value="" selected>Select...</option>
                                            <option value="">Information Technology</option>
                                        </select>

                                    </div>
                                    <div class="col-lg-6">
                                        <label>Instructor</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Course</th>
                            <th class="text-right" style="width: 10%;">Enrolled</th>
                            <th style="width: 10%;">Schedule</th>
                            <th>Instructor</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                             <td><b>J0427QM52Z</b><br/><a href="">Google IT Support Professional Certificate</a></td>
                            <td>Information Technology</td>
                            <td class="text-right"><a href="">10</a> / 100</td>
                            <td>MWF</td>
                            <td>Marshall Nichols</td>
                            <td>Active</td>
                            <td class="align-center">
                                    <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete"> <i class="icon-trash"></i> </button>
                                </td>
                        </tr>

                        <tr>
                              <td><b>XOPSDDEEE</b><br/><a href="">Key Technologies for Business Specialization</a></td>
                            <td>Information Technology</td>
                            <td class="text-right"><a href="">12</a> / 100</td>
                            <td>MWF</td>
                            <td>Susie Willis</td>
                            <td>Active</td>
                            <td class="align-center">
                                    <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete"> <i class="icon-trash"></i> </button>
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

            <div class="row "  style="float: left; margin-top:  10px">
               <div class="col-md-12">
                  <button class="btn btn-sm btn-success" style="width: 100px;">Print</button>
               </div>
           </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/projects/archives.js') }}"></script>
@endsection
