@extends('admin.template')

@section('title', 'Quizzes')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Quizzes</h1>

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
                        <a href="{{ route('edit-quiz', $quiz->quiz_id) }}" class="btn btn-success">Edit</a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>

                        <div class="dropdown-menu" x-placement="bottom-start">
                            <a href="" id="mark-as-active" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Mark as Active</a>
                            <a href="" id="mark-as-close" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Mark as Closed</a>
                        </div>

                        <div class="card margin-15">
                            <div class="body">
                                <!-- <form id="new" method="post" novalidate> -->
                                    <div class="form-group">
                                        <label>Title</label>
                                        <label class="block"><b>{{ $quiz->title }}</b></label>
                                        <!-- <input type="text" class="form-control" required name="title" value="{{ $quiz->title }}" disabled> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Instruction</label>
                                        <label class="block"><b>{{ $quiz->instruction }}</b></label>
                                        <!-- <textarea id="ckeditor" name="instruction" value="{{ $quiz->title }}" disabled></textarea> -->
                                    </div>

                                    <div class="form-group">
                                        <label>Course</label>
                                        <label class="block"><b>{{ $quiz->course_name }}</b></label>
                                        <!-- <div class="input-group">
                                            <select class="form-control" name="course_id" id="course" disabled>
                                                <option selected>Choose...</option>
                                            </select>
                                        </div> -->
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <label class="block"><b>{{ $quiz->class_name }}</b></label>
                                                <!-- <div class="input-group">
                                                    <select class="form-control" name="class_id" id="classes" disabled>
                                                        <option>Choose...</option>
                                                        <option selected value="{{ $quiz->class_id }}">{{ $quiz->class_name }}</option>
                                                    </select>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Class No.</label>
                                                <label class="block"><b>{{ $quiz->class_code }}</b></label>
                                                <!-- <input type="text" class="form-control" required name="class_no"  value="" disabled> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Points</label>
                                                <label class="block"><b>{{ $quiz->length }}</b></label>
                                                <!-- <input type="number" class="form-control" name="points"  value="{{ $quiz->length }}" disabled> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Allowed Attempts</label>
                                                <label class="block"><b>{{ $quiz->allowed_attempts }}</b></label>
                                                <!-- <input type="number" class="form-control" required name="allowed_attempts" value="{{ $quiz->allowed_attempts }}" disabled> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Start</label>
                                                <label class="block"><b>{{ date('Y-m-d', strtotime($quiz->start)) }}</b></label>
                                                <!-- <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control date" name="start" value="{{ date('Y-m-d', strtotime($quiz->start)) }}" disabled>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>End</label>
                                                <label class="block"><b>{{ date('Y-m-d', strtotime($quiz->end)) }}</b></label>
                                                <!-- <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control date" name="end" value="{{ date('Y-m-d', strtotime($quiz->end)) }}" disabled>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    <input id="quizID" type="hidden" value="{{ $quiz->quiz_id }}">
                    </form>

                    <div class="action-btn">
                        <a href="{{ route('recent-quiz') }}" class="btn btn-secondary" title="">Back</a>
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

    <script src="{{ URL::asset('admin/js/academic/quizzes/view.js') }}"></script>
@endsection
