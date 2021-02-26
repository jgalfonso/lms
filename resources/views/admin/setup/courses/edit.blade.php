@extends('admin.template')

@section('title', 'Setup - Courses (Edit)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Edit</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Name</label><span class="required"> * </span>
                                    <input  name="name" type="text" class="form-control" required value="{{ $course->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-btn" style="padding-bottom: 3%;">
                    <button type="button" href="" class="btn btn-success save" style="width: 100px;">Save</button>
                    <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
                </div>
            </div>

             <input name="courseID" type="hidden" value="{{ $course->course_id }}">  
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/setup/courses-edit.js') }}"></script>
@endsection
