@extends('admin.template')

@section('title', 'Submitted Attachments')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Submitted Attachments</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div id="alert"></div>
	<div class="row clearfix">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <form id="form" method="post" novalidate>
                        <div class="card margin-15">
                            <div class="body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <label class="block"><b>{{ $participant->assignment }}</b></label>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Class Code / Name</label>
                                            <label class="block"><b>{{ $participant->class_code }}</b> - <a href="{{ route('classes-view', $participant->class_id) }}">{{ $participant->class_name }}</a></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <label class="block"><b>{{ $participant->course_name }}</b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Student</label>
                                    <label class="block"><b>{{ $participant->student }}</b></label>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Allowed Attempts</label>
                                            <label class="block"><b>{{ $participant->allowed_attempts }}</b></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Attempts</label>
                                            <label class="block"><b>{{ $participant->attempt }}</b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Date Submitted</label>
                                    <label class="block"><b>{{ date('Y-m-d', strtotime($participant->date_created)) }}</b></label>
                                </div>
                            </div>
                        </div>
                    <input id="participantID" type="hidden" value="{{ $participant->participant_id }}">
                    </form>

                    <div class="card">
                        <div class="header">
                            <h2>Attachment</h2>
                        </div>

                        <div class="table-responsive">
                            <table id="dt" class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>Filename</th>
                                        <th class="text-center th-action"><i class="fa fa-level-down"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>image.jpeg</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Assess"><i class="fa fa-download"></i></button>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row action-mark">
                            <div class="col-md-12">
                                <button id="mark-as-completed" class="btn btn-success btn-complete" type="button">Mark as Completed</button>
                                <a href="{{ route('evaluation-assignment') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/academic/assignments/submitted-attachments.js') }}"></script>
@endsection
