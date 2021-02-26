@extends('admin.template')

@section('title', 'Setup - Classes (Edit)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

    <style type="text/css">
        .parsley-errors-list {
            width: 100%;
        }
    </style>
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

        <form id="form" method="post" novalidate>
            <div class="col-lg-12">
                <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
            </div> 

            <div class="col-lg-12" style="margin-top: 15px;">
                <div class="card">
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" readonly value="{{ $class->code }}" style="font-weight: bold;">
                                </div>
                            </div>

                            <div class="col-lg-6">
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Name</label><span class="required"> * </span>
                                    <input  name="name" type="text" class="form-control" required value="{{ $class->name }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label><span class="required"> * </span>
                                    <textarea name="description" class="form-control" rows="5" required>{{ $class->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Course</label><span class="required"> * </span>
                                    <select name="courseID" class="form-control" required>
                                        <option value="" selected>Choose...</option>
                                        
                                        @foreach ($courses as $row)
                                            <option @if($class->course_id == $row->course_id) selected @endif value="{{ $row->course_id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Instructor</label><span class="required"> * </span>
                                    <select name="instructorID" class="form-control" required>
                                        <option value="" selected="">Choose...</option>

                                        @foreach ($faculty as $row)
                                            <option @if($class->instructor_id == $row->profile_id) selected @endif value="{{ $row->profile_id }}">{{ $row->lastname }}, {{ $row->firstname }} {{ $row->middlename }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Units</label>
                                    <input name="units" type="number" class="form-control" value="{{ $class->units }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                   <label>Google Meet - Link</label>
                                   <input name="googleMeetLink" type="text" class="form-control" value="{{ $class->google_meet_link }}">
                               </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Type Schedules</label><span class="required"> * </span>
                                    <select name="scheduleTypeID" class="form-control" required>
                                        <option value="" selected="">Choose...</option>

                                        @foreach ($schedule_types as $row)
                                            <option @if($class->schedule_type_id == $row->schedule_type_id) selected @endif value="{{ $row->schedule_type_id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
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

                    <div class="body schedules" style="margin-bottom: 15px;">
                        <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Day</label><span class="required"> * </span>
                                    <select name="day[]" class="form-control" required>
                                        <option value="" selected="">Choose...</option>
                                        <option value="1">Sunday</option>
                                        <option value="2">Monday</option>
                                        <option value="3">Tuesday</option>
                                        <option value="4">Wednesday</option>
                                        <option value="5">Thursday</option>
                                        <option value="6">Friday</option>
                                        <option value="7">Saturday</option>
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
                                        <input name="start[]" type="text" class="form-control time12" placeholder="Ex: 11:59 PM" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>End</label><span class="required"> * </span>
                                    <label class="float-right"><a href="javascript:void(0);" class="remove hidden">Remove </a></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input name="end[]" type="text" class="form-control time12" placeholder="Ex: 11:59 PM" required>
                                    </div>
                                </div>
                            </div>

                             <div class="col-lg-12">
                                <div class="text-right">
                                    <button id="add" type="button" class="btn btn-default btn-more"> <i class="fa fa-plus"></i> Add More</button>
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

             <input name="classID" type="hidden" value="{{ $class->class_id }}">  
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/setup/classes-edit.js') }}"></script>
@endsection
