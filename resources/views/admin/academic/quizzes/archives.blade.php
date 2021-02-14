@extends('admin.template')

@section('title', 'Quizzes')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
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
                    <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="dt">
                         <thead>
                            <tr>
                                <th class="text-center" style="width: 1%;">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </th>
                                <th>Title</th>
                                <th>Availability</th>
                                <th>Due Date</th>
                                <th style="width: 10%; ">Time Limit</th>
                                <th style="width: 1%; " class="text-center"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($quizzes as $quiz): ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox"><span></span></label>
                                        </div>
                                    </td>
                                    <td><a href="">{{ $quiz->title }}</a></td>
                                     <td>01/01/2021</td>
                                    <td>
                                        01/01/2021
                                    </td>
                                    <td>1hr</td>
                                    <td>
                                          <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row "  style="float: left; margin-top: -35px">
                    <div class="col-md-12">
                        <button class="btn btn-success" type="button">Mark as Active</button> <button class="btn btn-danger" type="button">Mark as Closed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>

    <script src="{{ URL::asset('admin/js/quizzes/archives.js') }}"></script>
@endsection
