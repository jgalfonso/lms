@extends('admin.template')

@section('title', 'Setup - Courses (ID: '.$course->course_id.')')

@section('css')
    
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>ID: {{ $course->course_id }}</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>
        
        <div class="col-lg-12">
            <a href="{{ route('courses-edit', $course->course_id) }}" class="btn btn-success" style="width: 100px;">Edit</a>
        </div> 

        <div class="col-lg-12" style="margin-top: 15px;">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Name</label>
                                <label class="block"><b>{{ $course->name }}</b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
   
@endsection
