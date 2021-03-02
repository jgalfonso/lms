@extends('admin.template')

@section('title', 'Quizzes')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

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
                    <div class="card">
                        <div class="header">
                            <h2>Quizzes</h2>
                        </div>

                        <div class="body">
                            <form id="edit" method="post" novalidate>
                                <div class="form-group">
                                    <label>Title</label><span class="required"> * </span>
                                    <input type="text" class="form-control" required name="title" value="{{ $quiz->title }}" >
                                </div>
                                <div class="form-group">
                                    <label>Instruction</label>
                                    <textarea id="ckeditor" name="instruction" value="{{ $quiz->title }}" ></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Course</label><span class="required"> * </span>
                                    <div class="input-group">
                                        <select class="form-control" name="course_id" id="course" >
                                            <option selected>Choose...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Class</label><span class="required"> * </span>
                                            <div class="input-group">
                                                <select class="form-control" name="class_id" id="classes" >
                                                    <option>Choose...</option>
                                                    <option selected value="{{ $quiz->class_id }}">{{ $quiz->class_name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Class No.</label><span class="required"> * </span>
                                            <input type="text" class="form-control" required name="class_no"  value="" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Points</label>
                                            <input type="number" class="form-control" name="points"  value="{{ $quiz->length }}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Allowed Attempts</label><span class="required"> * </span>
                                            <input type="number" class="form-control" required name="allowed_attempts" value="{{ $quiz->allowed_attempts }}" >
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
                                                <input type="text" class="form-control date" name="start" value="{{ date('Y-m-d', strtotime($quiz->start)) }}" >
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
                                                <input type="text" class="form-control date" name="end" value="{{ date('Y-m-d', strtotime($quiz->end)) }}" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="action-btn">
                        <button type="button" class="btn btn-success" id="save">Save</button>
                        <a href="{{ route('recent-quiz') }}" class="btn btn-danger" title="">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/quizzes/edit.js') }}"></script>
@endsection
