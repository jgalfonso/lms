@extends('admin.template')

@section('title', 'Dashboard')

@section('css')

@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Lesson</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Lesson</h2>
                        </div>

                        <div class="body">
                            <form id="basic-form" method="post" novalidate>
                                <div class="form-group">
                                    <label>Title</label><span style="color: red"> * </span>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Content</label><span style="color: red"> * </span>
                                    <textarea id="ckeditor" required></textarea>

                                </div>

                                <div class="form-group"  style="width: 50% !important">
                                     <label>Class</label><span style="color: red"> * </span>
                                    <div class="input-group">
                                        <select class="form-control">
                                            <option selected="">Choose...</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>Links</h2>
                        </div>

                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label><span style="color: red"> * </span>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>URL</label><span style="color: red"> * </span>
                                        <label class="float-right"><a href="">Clear</a></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>

                                 <div class="col-lg-12">
                                    <div class="text-right">
                                        <button id="addPic" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="card">
                        <div class="header">
                            <h2>Attachment</h2>
                        </div>

                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label><span style="color: red"> * </span>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Filename</label><span style="color: red"> * </span>
                                         <label class="float-right"><a href="">Clear</a> </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label><span style="color: red"> * </span>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Filename</label><span style="color: red"> * </span>
                                         <label class="float-right"><a href="">Clear</a> | <a href="">Remove</a></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-right">
                                        <button id="addPic" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-btn" style="padding-bottom: 3%;">
                        <button type="submit" class="btn btn-success" style="width: 100px">Save</button>
                        <a href="announcements.html" class="btn btn-danger" style="width: 100px">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('admin/js/lessons/new.js') }}"></script>
@endsection
