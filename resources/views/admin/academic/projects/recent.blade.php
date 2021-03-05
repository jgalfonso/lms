@extends('admin.template')

@section('title', 'Projects')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Projects</h1>

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
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox" class="markAll"><span></span></label>
                                    </div>
                                </th>
                                <th>Title</th>
                                <th >Class Code / Name</th>
                                <th>Instructor</th>
                                <th>Start</th>
                                <th>End</th>
                                <th class="th-status">Status</th>
                                <th class="text-center th-action"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $project): ?>
                                <tr>
                                    <td>{{ $project->project_id }}</td>
                                    <td class="text-center">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" class="mark"><span></span></label>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('view-project', $project->project_id) }}">{{ $project->title }}</a></td>
                                    <td><b>{{ $project->class_code }}</b><br />{{ $project->class_name }}</td>
                                    <td>
                                        <div class="font-15">{{ $project->instructor }}</div>
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($project->start)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($project->end)) }}</td>
                                    <td>{{ $project->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit-project', $project->project_id) }}" type="button" type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row action-mark" style="margin-top: -35px;">
                    <div class="col-md-12">
                        <button class="btn btn-success btn-mark" id="markActive" type="button">Mark as Active</button>
                        <button class="btn btn-danger btn-mark" id="markClose" type="button">Mark as Closed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/academic/projects/recent.js') }}"></script>
@endsection
