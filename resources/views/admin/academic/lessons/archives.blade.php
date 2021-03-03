@extends('admin.template')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Lesson</h1>

        @include('admin.includes.breadcrumb')
    </div>

        <div class="col-md-6 col-sm-12 text-right">
            <a href="{{ route('new-lesson') }}" class="btn btn-sm btn-primary" title="">New Lesson</a>
        </div>
@endsection

@section('content')
<div id="alert"></div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <label>Filter by Class:</label>
                            <div class="input-group">
                                <select class="form-control" id="classes">
                                    <option selected="">Choose...</option>
                                    <?php if (!empty($classes)): ?>
                                        <?php foreach ($classes as $class): ?>
                                            <option value="{{ $class->class_id }}">{{ $class->name }}</option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="dt" class="table dataTable">
                         <thead>
                            <tr>
                                <th class="text-center th-mark">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </th>
                                <th>Title</th>
                                <th >Class Code / Name</th>
                                <th>Instructor</th>
                                <th class="th-status">Status</th>
                                <th class="text-center"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lessons as $lesson): ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('view-lesson', $lesson->lesson_id) }}">{{ $lesson->title }}</a></td>
                                     <td><b>{{ $lesson->class_code }}</b><br />{{ $lesson->class_name }}</td>
                                    <td>
                                        <div class="font-15">Debra Stewart</div>
                                    </td>
                                    <td>{{ $lesson->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit-lesson', $lesson->lesson_id) }}" type="button" type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row action-mark">
                    <div class="col-md-12">
                        <button class="btn btn-mark btn-success" type="button">Mark as Active</button>
                        <button class="btn btn-mark btn-danger" type="button">Mark as Closed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>

    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/academic/lessons/archives.js') }}"></script>
@endsection
