@extends('admin.template')

@section('title', 'Quizzes')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
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
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <label>Filter by Class:</label>
                            <div class="input-group">
                                <select class="form-control" id="classes">
                                    <option value="">Choose...</option>
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
                                <th></th>
                                <th class="text-center th-mark">
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" class="select-all"><span class="th-mark"></span>
                                    </label>
                                </th>
                                <th>Title</th>
                                <th >Class Code / Name</th>
                                <th>Availability</th>
                                <th>Due Date</th>
                                <th>Time Limit</th>
                                <th class="th-status">Status</th>
                                <th class="text-center th-action"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($quizzes as $quiz): ?>
                                <tr>
                                    <td>{{ $quiz->quiz_id }}</td>
                                    <td class="text-center th-mark">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" class="checkbox"><span class="th-mark"></span>
                                        </label>
                                    </td>
                                    <td><a href="{{ route('view-quiz', $quiz->quiz_id) }}">{{ $quiz->title }}</a></td>
                                    <td><b>{{ $quiz->class_code }}</b><br />{{ $quiz->class_name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($quiz->start)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($quiz->end)) }}</td>
                                    <td>1hr</td>
                                    <td>{{ $quiz->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit-quiz', $quiz->quiz_id) }}" type="button" type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row action-mark">
                    <div class="col-md-12">
                        <button id="mark-as-active" class="btn btn-success btn-mark" type="button">Mark as Active</button>
                        <button id="mark-as-close" class="btn btn-danger btn-mark" type="button">Mark as Closed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/academic/quizzes/recent.js') }}"></script>
@endsection
