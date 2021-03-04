@extends('admin.template')

@section('title', 'Services - Enrollment (Class Summary)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <style type="text/css">
        .modal-body table th, .modal-body table td {
            background: #f6f7f9 !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Class Summary</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right hidden-xs">

    </div>
@endsection

@section('content')
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
                                        <input type="text" id="class_no" class="form-control" name="title">
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Status</label>
                                        <select class="form-control" id="status">
                                            <option value="" selected>Select...</option>
                                            <option value="">Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6">
                                        <label>Name / Student No.</label>
                                        <input type="text" id="student_no" class="form-control" name="title">
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
                                            <input type="text" id="to" data-date-autoclose="true" class="form-control date" name="date_closed" >
                                        </div>
                                         <span class="help-block">End Date</span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6">
                                        <label>Course</label>
                                        <select class="form-control" id="course">
                                            <option value="" selected>Select...</option>
                                            <?php foreach ($courses as $course): ?>
                                                <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                                            <?php endforeach; ?>


                                        </select>

                                    </div>
                                    <div class="col-lg-6">
                                        <label>Instructor</label>
                                        <input type="text" id="instructor" class="form-control" name="title">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-4 col-sm-6 text-right">
                                         <label>&nbsp;</label>
                                         <button type="button" name="button" id="search" class="btn btn-info btn-block" title="Search" style="width: 100px">Search</button>
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
                <table id="dt" class="table dataTable">
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
                        @foreach ($summary as $row)
                            <tr>
                                <td><b>{{ $row->code }}</b><br/><a href="{{ route('classes-view', $row->class_id) }}">{{ $row->name }}</a></td>
                                <td>{{ $row->course }}</td>
                                <td class="text-right"><a onclick="view({{ $row->class_id }});" style="cursor: pointer; color: #007bff;">{{ $row->enrollees }}</a></td>
                                <td></td>
                                <td>{{ $row->instructor }}</td>
                                <td>{{ $row->status }}</td>
                                <td class="align-center">
                                    <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete"> <i class="icon-trash"></i> </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row  action-mark">
               <div class="col-md-12">
                  <button class="btn btn-sm btn-success" style="width: 100px;">Print</button>
               </div>
           </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enrolled</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding: 10px 0 10px 0">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped js-basic-example dataTable table-custom spacing5 mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 30%;">Student No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default" style="width: 100px;">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/enrollment/class-summary.js') }}"></script>
@endsection
