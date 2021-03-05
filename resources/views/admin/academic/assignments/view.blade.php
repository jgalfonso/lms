@extends('admin.template')

@section('title', 'Assignments')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Assignments</h1>

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
                        <a href="{{ route('edit-assignment', $assignment->assignment_id) }}" class="btn btn-success">Edit</a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>

                        <div class="dropdown-menu" x-placement="bottom-start">
                            <a href="" id="mark-as-active" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Mark as Active</a>
                            <a href="" id="mark-as-close" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Mark as Closed</a>
                        </div>

                        <div class="card margin-15">
                            <div class="body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <label class="block"><b>{{ $assignment->title }}</b></label>
                                </div>
                                <div class="form-group">
                                    <label>Instruction</label>
                                    <label class="block"><b>{{ $assignment->instruction }}</b></label>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <label class="block"><b>{{ $assignment->course_name }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Class</label>
                                            <label class="block"><b>{{ $assignment->class_name }}</b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Instructor</label>
                                    <label class="block"><b>{!! $assignment->instructor !!}</b></label>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Points</label>
                                            <label class="block"><b>{{ $assignment->points }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Allowed Attempts</label>
                                            <label class="block"><b>{{ $assignment->allowed_attempts }}</b></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Start</label>
                                            <label class="block"><b>{{ date('Y-m-d', strtotime($assignment->start)) }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>End</label>
                                            <label class="block"><b>{{ date('Y-m-d', strtotime($assignment->end)) }}</b></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <input id="assignmentID" type="hidden" value="{{ $assignment->assignment_id }}">
                    </form>

                    <div class="action-btn">
                        <a href="{{ route('recent-assignment') }}" class="btn btn-secondary" title="">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/academic/assignments/view.js') }}"></script>
@endsection
