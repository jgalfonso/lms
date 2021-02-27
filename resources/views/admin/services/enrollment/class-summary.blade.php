@extends('admin.template')

@section('title', 'Services - Enrollment (Class Summary)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Class Summary</h1>

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
                        <label>Filter by Course:</label>
                        <div class="input-group">
                            <select id="course_id" class="form-control">
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
                            <th>Admission Code</th>
                            <th>Profile</th>
                            <th>Class Code / Name</th>
                            <th style="width: 20%;">Course</th>
                            <th style="width: 10%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->admission_id }}</td>
                                <td>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" class="checkbox"><span style="width: 1%;"></span>
                                    </label>
                                </td>
                                <td>{{ $row->code }}</td>
                                <td>{{ $row->firstname . ' ' . $row->lastname}}</td>
                                <td><b>{{ $row->class_code }}</b><br/><a href="{{ route('classes-view', $row->class_id) }}">{{ $row->class_name }}</a></td>
                                <td>{{ $row->course_name }}</td>
                                <td>{{ $row->status }}</td>
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
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/enrollment/class-summary.js') }}"></script>
@endsection
