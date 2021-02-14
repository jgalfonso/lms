@extends('admin.template')

@section('title', 'Class')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Class</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div id="alert"></div>
	<div class="row clearfix">
        <div class="col-lg-12">
            <form id="new" method="post" novalidate>
                <div class="card">
                    <div class="body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Name</label><span class="required"> * </span>
                                    <input type="text" class="form-control" required name="title">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label><span class="required"> * </span>
                                    <textarea class="form-control" rows="5"></textarea>
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
                                    <label>Instructor</label><span class="required"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="instructor_id" id="instructor">
                                            <option selected="">Choose...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Units</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                   <label>Google Meet - Link</label>
                                   <input type="text" class="form-control" >
                               </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Type Schedules</label><span class="required"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="type_schedule_id" id="type_schedule">
                                            <option selected="">Choose...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>Schedules</h2>
                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Day</label><span class="required"> * </span>
                                         <select class="form-control">
                                        <option selected="">Choose...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Start</label><span class="required"> * </span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control time12" placeholder="Ex: 11:59 PM">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>End</label><span class="required"> * </span>
                                    <label class="float-right"><a href="">Clear</a></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control time12" placeholder="Ex: 11:59 PM">
                                    </div>
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Day</label><span class="required"> * </span>
                                         <select class="form-control">
                                        <option selected="">Choose...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Start</label><span class="required"> * </span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control time12" placeholder="Ex: 11:59 PM">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>End</label><span class="required"> * </span>
                                    <label class="float-right"><a href="">Clear</a> | <a href="">Remove</a></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control time12" placeholder="Ex: 11:59 PM">
                                    </div>
                                </div>
                            </div>

                             <div class="col-lg-12">
                                <div class="text-right">
                                    <button id="addAttach" type="button" class="btn btn-default btn-more"> <i class="fa fa-plus"></i> Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-btn" style="padding-bottom: 3%;">
                    <button type="button" class="btn btn-success" id="save" style="width: 100px">Save</button>
                    <a href="announcements.html" class="btn btn-danger" style="width: 100px">Cancel</a>
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

    <script src="{{ URL::asset('admin/js/projects/new.js') }}"></script>
@endsection
