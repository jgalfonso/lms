@extends('admin.template')

@section('title', 'Setup - Classes (Code: '.$class->code.')')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Code: {{ $class->code }}</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate>
            <div class="col-lg-12">
                <a href="{{ route('classes-edit', $class->class_id) }}" class="btn btn-success" style="width: 100px;">Edit</a>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>

                <div class="dropdown-menu" x-placement="bottom-start">
                    <a href="" id="mark-as-active" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Mark as Active</a>
                    <a href="" id="mark-as-close" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Mark as Closed</a>
                </div>
            </div>

            <div class="col-lg-12" style="margin-top: 15px;">
                <div class="card">
                    <div class="body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <label class="block"><b>{{ $class->name }}</b></label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <label class="block">{{ $class->description }}</label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Course</label>
                                    <label class="block"><b>{{ $class->course }}</b></label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Instructor</label>
                                    <label class="block"><b>{{ $class->instructor }}</b></label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Units</label>
                                    <label class="block">{{ $class->units }}</label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Google Meet - Link</label>
                                    <label class="block">{{ $class->google_meet_link }}</label>
                               </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Type Schedules</label>
                                    <label class="block"><b>{{ $class->code }}</b></label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <label class="block">{{ $class->status }}</label>
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

                        </div>
                    </div>
                </div>
            </div>

            <input id="classID" type="hidden" value="{{ $class->class_id }}">  
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/setup/classes-view.js') }}"></script>
@endsection
