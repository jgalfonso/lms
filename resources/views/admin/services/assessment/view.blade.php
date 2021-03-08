@extends('admin.template')

@section('title', 'Assessment')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Assessment</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">

        <div class="card">
            <div class="header">
                <h2>Basic Information</h2>
            </div>

            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tr>
                                <td>Class Code / Name</td>
                                <td style="width:80%" id="class_code">: <b>{{ $assessment->class_code }}</b></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="class_name">: <a href="#">{{ $assessment->class_name }}</a></td>
                            </tr>
                            <tr>
                                <td>Course</b></td>
                                <td id="course_name">: {{ $assessment->course_name }}</td>
                            </tr>

                            <tr>
                                <td>Instructor</td>
                                <td id="instructor">: {{ $assessment->instructor }}</td>
                            </tr>
                            <tr>
                                <td>Schedule</td>
                                <td id="schedule">: @if($assessment->start) {{ date('d/m/Y', strtotime($assessment->start)) }} - @endif @if($assessment->end) {{ date('d/m/Y', strtotime($assessment->end)) }} @endif</td>
                            </tr>
                            <tr>
                                <td>No. of Trainees</td>
                                <td id="no_trainees">: {{ count($trainees) }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td id="class_status">: {{ $assessment->status }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-7"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="header">
                <h2>Assessment Details </h2>
            </div>

            <div class="body">
               <div class="row">
                  <div class="col-md-12">
                       <table style="width: 100%">
                           <tr>
                               <td>Assessor</b></td>
                               <td style="width:80%">: {{ $assessment->assessor_lastname . ', ' . $assessment->assessor_firstname . $assessment->middlename }}</td>
                           </tr>

                           <tr>
                               <td>Assesssment Date</td>
                               <td>: {{ date('d/m/Y', strtotime($assessment->date_assessed)) }}</td>
                           </tr>
                           <tr>
                               <td>Passed</td>
                               <td>: {{ $assessment->passed }}</td>
                           </tr>
                           <tr>
                               <td>Failed</td>
                               <td>: {{ $assessment->failed }}</td>
                           </tr>
                           <tr>
                               <td>Incomplete</td>
                               <td>: {{ $assessment->incomplete }}</td>
                           </tr>
                       </table>
                   </div>

                   <div class="col-lg-7"></div>

               </div>
           </div>

            <div class="table-responsive" style="margin-top: 15px;">
                <table id="trainees" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Student No.</th>
                            <th>Name of Trainee</th>

                            <th class="text-center" style="width: 15%">Passed</th>
                            <th class="text-center" style="width: 15%">Failed</th>
                            <th class="text-center" style="width: 15%">Incomplete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trainees as $trainee): ?>
                            <tr>
                                <td>{{ $trainee->registration_no }}</td>
                                <td><a href="">{{ $trainee->trainee_name }}</a><br>{{ $trainee->email }}</td>

                                <td class="text-center">
                                    <?php if ($trainee->passed == 1): ?>
                                        <label><i class="fa fa-check text-success"></i></label>
                                    <?php endif; ?>

                                </td>
                                <td class="text-center">
                                    <?php if ($trainee->failed == 1): ?>
                                        <label><i class="fa fa-check text-danger"></i></label>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($trainee->incomplete == 1): ?>
                                        <label><i class="fa fa-check text-default"></i></label>
                                    <?php endif; ?>
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
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/assessment/view.js') }}"></script>
@endsection
