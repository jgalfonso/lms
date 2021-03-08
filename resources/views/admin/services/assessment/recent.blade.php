@extends('admin.template')

@section('title', 'Assessment')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Assessment</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right">
	    <a href="{{ url('admin/services/assessment/new') }}" class="btn btn-new btn-sm btn-primary" title="New Assessment">New Assessment</a>
	</div>
@endsection

@section('content')
    <div id="alert"></div>
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
                                        <label>Filter by Name / Class No:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="class" placeholder="Search...">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-6 text-right">
                                         <label>&nbsp;</label>
                                         <button type="button" name="button" id="search" class="btn btn-info btn-block" title="Search" style="width: 100px">Search</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                   <table id="myTable" class="table dataTable">
                        <thead>
                            <tr>
                                <th>Class Code / Name</th>
                                <th>Course</th>
                                <th class="text-right" style="width: 10%">Trainee's</th>
                                <th>Assessor</th>
                                <th style="width: 10%"1>Assessment Date</th>
                                <th class="text-right"  style="width: 10%">Grade (P / F / I)</th>
                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($assessments as $assess): ?>
                                <tr>
                                    <td><b>{{ $assess->class_code }}</b><br/><a href="{{ route('classes-view', $assess->class_id) }}">{{ $assess->class_name }}</td>
                                     <td>
                                        <div class="font-15">{{ $assess->course_name }}</div>
                                    </td>
                                    <td class="text-right"><a href="#">{{ $assess->trainees }}</a></td>
                                    <td class="text-right">{{ $assess->assessor_lastname . ', ' . $assess->assessor_firstname }}</td>

                                    <td>{{ date('d M Y', strtotime($assess->date_assessed)) }}</td>
                                    <td class="text-right"><a href="">{{ $assess->passed }}</a> / <a href="">{{ $assess->failed }}</a> / <a href="">{{ $assess->incomplete }}</a></td>
                                    <td class="align-center">
                                        <a  href="{{ route('view-assessment', $assess->assessment_id) }}" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
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
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/assessment/recent.js') }}"></script>
@endsection
