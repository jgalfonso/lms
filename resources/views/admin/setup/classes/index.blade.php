@extends('admin.template')

@section('title', 'Classes')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Classes</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right">
	    <a href="{{ url('admin/setup/classes/new') }}" class="btn btn-new btn-sm btn-primary" title="New Page">New Class</a>
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
                            <label>Filter by Course:</label>
                            <div class="input-group">
                                <select id="courses" class="form-control">
                                    <option value="">Choose...</option>

                                    @foreach ($courses as $row)
                                        <option value="{{ $row->course_id }}">{{ $row->name }}</option>
                                    @endforeach
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
                                <th style="width: 1%;">
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" class="select-all"><span style="width: 1%;"></span>
                                    </label>
                                </th>
                                <th>Class Code / Name</th>
                                <th style="width: 20%;">Course</th>
                                <th style="width: 20%;">Instructor</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 1%;"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $row)
                                <tr>
                                    <td>{{ $row->course_id }}</td>
                                    <td>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" class="checkbox"><span style="width: 1%;"></span>
                                        </label>
                                    </td>
                                    <td><b>{{ $row->code }}</b><br/><a href="{{ route('classes-view', $row->class_id) }}">{{ $row->name }}</a></td>
                                    <td>{{ $row->course }}</td>
                                    <td>{{ $row->instructor }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td class="align-center"><a href="{{ route('classes-edit', $row->class_id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row action-mark">
                    <div class="col-md-12">
                        <button id="mark-as-active" class="btn btn-success" type="button" style="width: 140px;">Mark as Active</button>
                        <button id="mark-as-close" class="btn btn-danger" type="button" style="width: 140px;">Mark as Closed</button>
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

    <script src="{{ URL::asset('admin/js/setup/classes.js') }}"></script>
@endsection
