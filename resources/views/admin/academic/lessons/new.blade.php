@extends('admin.template')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
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
                                    <label>Title</label><span class="required"> * </span>
                                    <input type="text" class="form-control" required name="title">
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Course</label><span class="required"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="course_id" id="course">
                                            <option selected>Choose...</option>
                                            <?php foreach ($courses as $course): ?>
                                                <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Class</label><span class="required"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="class_id" id="classes" disabled>
                                            <option selected="">Choose...</option>
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
                                        <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="start" >
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
                                        <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="end" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" name="code">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea id="ckeditor" name="content"></textarea>
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
                        <div class="col-lg-12 links">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label><span class="required"> * </span>
                                        <input type="text" class="form-control" required name="link_title[]">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>URL</label><span class="required"> * </span>
                                        <label class="float-right"><a href="javascript:void(0);" class="clearLink">Clear </a> </label>
                                        <input type="text" class="form-control" required name="link_url[]">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 link newLink links">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label><span class="required"> * </span>
                                        <input type="text" class="form-control" required name="link_title[]">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>URL</label><span class="required"> * </span>
                                        <label class="float-right"><a href="javascript:void(0);" class="clearLink">Clear </a> | <a href="javascript:void(0);" class="removeLink">Remove </a></label>
                                        <input type="text" class="form-control" required name="link_url[]">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="text-right">
                                <button id="addLink" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add More</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>Attachment</h2>
                    </div>

                    <div class="body">
                        <div class="col-lg-12 attachs">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label><span class="required"> * </span>
                                        <input type="text" class="form-control" required name="attach_title[]">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Filename</label><span class="required"> * </span>
                                        <label class="float-right"><a href="javascript:void(0);" class="clearAttach">Clear </a> </label>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" id="inputGroupFile01" name="attach_file[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 newAttach attach attachs">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label><span class="required"> * </span>
                                        <input type="text" class="form-control" required name="attach_title[]">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Filename</label><span class="required"> * </span>
                                         <label class="float-right"><a href="javascript:void(0);" class="clearAttach">Clear </a> | <a href="javascript:void(0);" class="removeAttach">Remove </a></label>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" id="inputGroupFile01" name="attach_file[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="text-right">
                                <button id="addAttach" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add More</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-btn">
                    <button type="button" class="btn btn-success" id="save">Save</button>
                    <a href="{{ route('lesson-plan') }}" class="btn btn-danger" title="">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/academic/lessons/new.js') }}"></script>
@endsection
