@extends('admin.template')

@section('title', 'Setup - Courses (New)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>New</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div class="row">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Name</label><span class="required"> * </span>
                                    <input  name="name" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-btn">
                    <button type="button" href="" class="btn btn-success save" style="width: 100px;">Save</button>
                    <a href="/admin/setup/courses" class="btn btn-danger" style="width: 100px">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/setup/courses-new.js') }}"></script>
@endsection
