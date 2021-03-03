@extends('admin.template')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Lesson</h1>

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
                        <h2>Lesson</h2>
                    </div>

                    <div class="body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Title</label><span style="color: red"> * </span>
                                    <input type="text" class="form-control" required name="title" value="{{ $lesson->title }}" disabled>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Course</label><span style="color: red"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="course_id" id="course">
                                            <option selected>Choose...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Class</label><span style="color: red"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="class_id" id="classes" disabled>
                                            <option selected="">Choose...</option>
                                            <option value="{{ $lesson->class_id }}"> {{ $lesson->class_name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Start Date:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="start" value="{{ date('Y-m-d', strtotime($lesson->start)) }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>End Date:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="end" value="{{ date('Y-m-d', strtotime($lesson->end)) }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" name="code" value="{{ $lesson->code }}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea id="ckeditor" name="content" value="{{ $lesson->content }}" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>Links</h2>
                    </div>

                    <div class="body">
                        <?php if (count($links) != 0): ?>
                            <?php foreach ($links as $link): ?>
                                <div class="col-lg-12 links">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Title</label><span style="color: red"> * </span>
                                                <input type="text" class="form-control" required name="link_title[]" value="{{ $link->title }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>URL</label><span style="color: red"> * </span>
                                                <label class="float-right"> </label>
                                                <input type="text" class="form-control" required name="link_url[]" value="{{ $link->url }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No links available.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>Attachment</h2>
                    </div>

                    <div class="body">
                        <?php if (count($attachments) != 0): ?>
                            <?php foreach ($attachments as $attachment): ?>
                                <div class="col-lg-12 attachs">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Title</label><span style="color: red"> * </span>
                                                <input type="text" class="form-control" required name="attach_title[]" value="{{ $attachment->title }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Filename</label><span style="color: red"> * </span>
                                                <label class="float-right"></label>
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="inputGroupFile01" name="attach_file[]" value="{{ $attachment->filename }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="action-btn" style="padding-bottom: 3%;">
                    <!-- <button type="button" class="btn btn-success" id="save" style="width: 100px">Save</button> -->
                    <a href="{{ route('lesson-plan') }}" class="btn btn-secondary" title="" style="width: 100px">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/academic/lessons/new.js') }}"></script>
@endsection
