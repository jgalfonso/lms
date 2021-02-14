@extends('admin.template')

@section('title', 'Assignments')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

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
                    <form id="new" method="post" novalidate>
                        <div class="card">
                            <div class="header">
                                <h2>Assignments</h2>
                            </div>

                            <div class="body">

                                <div class="form-group">
                                    <label>Title</label><span class="required"> * </span>
                                    <input type="text" class="form-control" required name="title" value="{{ $assignment->title }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Instruction</label>
                                    <textarea id="ckeditor" name="instruction" value="{{ $assignment->instruction }}" disabled></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Course</label><span style="color: red"> * </span>
                                            <div class="input-group">
                                                <select class="form-control" name="course_id" id="course" disabled>
                                                    <option selected="">Choose...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Class</label><span style="color: red"> * </span>
                                            <div class="input-group">
                                                <select class="form-control" name="class_id" id="classes" disabled>
                                                    <option>Choose...</option>
                                                    <option selected value="{{ $assignment->class_id }}">{{ $assignment->class_name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                     <label>Instructor</label><span class="required"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="instructor" disabled>
                                            <option>Choose...</option>
                                            <option selected value="{{ $assignment->instructor_id }}">Sample Sir</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Points</label>
                                            <input type="number" class="form-control" required name="points" value="{{ $assignment->points }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Allowed Attempts</label><span class="required"> * </span>
                                            <input type="number" class="form-control" required name="allowed_attempts" value="{{ $assignment->allowed_attempts }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Start</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control date" name="start" value="{{ date('Y-m-d', strtotime($assignment->instructor_id)) }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>End</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control date" name="end" value="{{ date('Y-m-d', strtotime($assignment->instructor_id)) }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="header">
                                <h2>Attachment</h2>
                            </div>

                            <div class="body">
                                <?php if (count($attachments) != 0): ?>
                                    <?php foreach ($attachments as $key => $attachment): ?>
                                        <div class="col-lg-12 attachs">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Title</label><span class="required"> * </span>
                                                        <input type="text" class="form-control" required value="{{ $attachment->title }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Filename</label><span style="color: red"> * </span>
                                                        <div class="custom-file">
                                                            <input type="file" class="form-control value="{{ $attachment->filename }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No attachments available.</p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </form>

                    <div class="action-btn" style="padding-bottom: 3%;">
                        <!-- <button type="button" class="btn btn-success" id="save" style="width: 100px">Save</button> -->
                        <a href="{{ route('recent-assignment') }}" class="btn btn-secondary" title="" style="width: 100px">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/assignments/new.js') }}"></script>
@endsection
