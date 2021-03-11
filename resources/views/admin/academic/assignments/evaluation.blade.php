@extends('admin.template')

@section('title', 'Assignment Submitted & Evaluation')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Assignment Submitted & Evaluation</h1>

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
                                        <label>Class</label>
                                        <div class="input-group">
                                            <select class="form-control" name="class_id" id="classes" disabled>
                                                <option value="">Choose...</option>
                                                <?php if (!empty($classes)): ?>
                                                    <?php foreach ($classes as $class): ?>
                                                        <option value="{{ $class->class_id }}">{{ $class->name }}</option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-6">
                                        <label>Student No. / Name:</label>
                                        <div class="input-group">
                                            <input id="keyword" type="text" class="form-control" placeholder="Search...">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-6 text-right">
                                        <label>&nbsp;</label>
                                        <button id="search" type="button" class="btn btn-sm btn-info btn-block" style="width: 100px">Search</button>
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
                                <th>Student No. / Name</th>
                                <th>Title / Class Code / Name</th>
                                <th>Attachment/s</th>
                                <th>Date Submitted</th>
                                <th class="text-center th-action"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($participants as $participant) : ?>
                                <tr>
                                    <td>
                                        <b>{{ $participant->student_no }}</b><br />
                                        <a href="{{ route('students-view', $participant->student_id) }}">{{ $participant->student }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('view-assignment', $participant->student_id) }}">{{ $participant->assignment }}</a><br />
                                        <b>{{ $participant->class_code }}</b><br />
                                        <a href="{{ route('classes-view', $participant->class_id) }}">{{ $participant->class_name }}</a>
                                    </td>
                                    <td class="text-right">3 </td>
                                    <td>{{ date('d-m-Y', strtotime($participant->date_created)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('assignments-submitted-attachments', $participant->participant_id) }}" type="button" type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></a>
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
    <script src="{{ URL::asset('admin/js/academic/assignments/evaluation.js') }}"></script>
@endsection
