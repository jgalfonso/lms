@extends('admin.template')

@section('title', 'Reports - Trainees')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Trainees</h1>

        @include('admin.includes.breadcrumb')
    </div>

@endsection

@section('content')
	<div class="row clearfix">
        <div class="col-md-12">
            <div class="card" style="margin-bottom: 10px;">
                <div class="body">
                    <ul class="accordion2" style="border: 0;">
                        <li class="accordion-item" style="border: 0;">
                            <h3 class="accordion-thumb"><span>Filter</span></h3>
                            <div class="accordion-panel" style="display: none;">
                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6 col-md-4 col-sm-6">
                                        <label>Course</label>
                                        <div class="input-group">
                                            <select class="form-control" name="course_id" id="course">
                                                <option value="">Choose...</option>
                                                <?php if (!empty($courses)): ?>
                                                    <?php foreach ($courses as $course): ?>
                                                        <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-6">
                                        <label>Trainee No. / Name:</label>
                                        <div class="input-group">
                                            <input id="keyword" type="text" class="form-control" placeholder="Search...">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-6 text-right">
                                        <label>&nbsp;</label>
                                        <button id="search" type="button" class="btn btn-sm btn-info btn-block">Search</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="dt" class="table dataTable">
                        <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th>Trainee No. / Name</th>
                                <th>Course</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profiles as $profile): ?>
                                <tr>
                                    <!-- <td>{{ $profile->course_id }}</td> -->
                                    <td>{{ $profile->trainee }}</td>
                                    <td>{{ $profile->course }}</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/reports/trainees/trainees.js') }}"></script>
@endsection
