@extends('admin.template')

@section('title', 'Services - Cerfifications (Moderate)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <style type="text/css">
        .parsley-errors-list {
            width: 100%;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Moderate</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div class="row clearfix">     
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
            </div>

            <div class="col-lg-12" style="margin-top: 15px;">
                <div class="card">
                    <div class="header">
                        <h2>Basic Information  <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table style="width: 100%">
                                             <tr>
                                                <td>Class Code / Name:</td>
                                                <td style="width:80%">: <b>{{ $entry->class_code }}</b></td>
                                            </tr>
                                            
                                            <tr>
                                                <td></td>
                                                <td>: <a href="{{ route('classes-view', $entry->class_id) }}">{{ $entry->class_name }}</a></td>
                                            </tr>

                                            <tr>
                                                <td>Course</b></td>
                                                <td>: {{ $entry->course }}</td>
                                            </tr>

                                            <tr>
                                                <td>Assessor</b></td>
                                                <td style="width:80%">: {{ $entry->assessor }}</td>
                                            </tr>

                                            <tr>
                                                <td>Assesssment Date</td>
                                                <td>: {{ date('d/m/Y', strtotime($entry->date_assessed)) }}</td>
                                            </tr>

                                            <tr>
                                                <td>Trainees</b></td>
                                                <td style="width:80%">: {{ $entry->trainees }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#trainees">Trainees</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#moderations">Moderations</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="trainees">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive" style="margin-top: 10px;">
                                        <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%;">Student No.</th>
                                                    <th>Name of Trainee</th>
                                                    <th style="width: 10%">Certification No.</th>
                                                    <th style="width: 10%">Registration No.</th>
                                                    <th style="width: 10%">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($certifications as $row)
                                                    <tr>
                                                        <td>{{ $row->control_no }}</td>
                                                        <td><a href="{{ route('students-view', $row->profile_id) }}">{{ $row->name }}</a><br>{{ $row->email }}</td>
                                                        <td>{{ $row->certificate_no }}</td>
                                                        <td>{{ $row->registration_no }}</td>
                                                        <td>Passed</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="moderations">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="margin-top: 15px;">
                                    @if(count($moderations))
                                        <div class="body mb-2">
                                            <ul style="list-style-type:circle; margin-bottom: 0; padding-inline-start: 20px;">
                                                @foreach ($moderations as $row)
                                                    <li class="mb-2">
                                                        Moderated by <strong><a href="{{ route('faculty-view', $row->created_by) }}">{{ $row->moderator }}</a></strong>
                                                       {{ \Carbon\Carbon::parse($row->dt_created)->diffForHumans() }}.
                                                        (<strong class="text-green">{{ $row->grade }}</strong>) 
                                                        <br>
                                                        Remarks: <small>{{ $row->remarks }}</small>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Date Moderate</label> <span class="required">*</span>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input id="dateModerated" name="dateModerated" type="text" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" value="{{ $today }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-8"> </div>

                                            <div class="col-lg-12">
                                                <label>Grade</label> <span class="required">*</span>
                                                <div class="form-group">
                                                    @if(IS_NULL($entry->grade_id))
                                                        <div class="fancy-checkbox" style="float:left">
                                                            <label>
                                                                <input id="forQA" name="forQA" type="checkbox" class="grade" checked= />
                                                                <span>For QA</span>
                                                            </label>
                                                        </div>
                                                    @endif

                                                    @if(IS_NULL($entry->grade_id) || $entry->grade_id == 1)
                                                        <div class="fancy-checkbox" style="float:left">
                                                            <label>
                                                                <input id="forApproval" name="forApproval" type="checkbox" class="grade" @if($entry->grade_id == 1) checked @endif />
                                                                <span>For Approval</span>
                                                            </label>
                                                        </div>
                                                    @endif

                                                    @if(IS_NULL($entry->grade_id) || $entry->grade_id == 1 || $entry->grade_id == 2)
                                                        <div class="fancy-checkbox" style="float:left">
                                                            <label>
                                                                <input id="approved" name="approved"  type="checkbox" class="grade" @if($entry->grade_id == 2) checked @endif />
                                                                <span>Approved</span>
                                                            </label>
                                                        </div>
                                                    @endif

                                                    @if(IS_NULL($entry->grade_id) || $entry->grade_id == 1 || $entry->grade_id == 2 || $entry->grade_id == 3)
                                                        <div class="fancy-checkbox" style="float:left">
                                                            <label>
                                                                <input id="published" name="published" type="checkbox" class="grade" @if($entry->grade_id == 3) checked @endif />
                                                                <span>Published</span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-12" style="margin-top: 15px;">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea id="remarks" name="remarks" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                    <div class="action-btn" style="padding-bottom: 3%;">
                        <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                        <a href="javascript:history.back()" class="btn btn-danger" style="width: 100px">Cancel</a>
                    </div>
                </div>
            </div>

            <input name="assessmentID" type="hidden" value="{{ $entry->assessment_id }}">  
        </form>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p>Are you sure you want to moderate this record?</p>
                        <div class="form-group">
                            <label>Valid For</label>
                            <select class="form-control">
                                <option selected="">Choose...</option>
                                <option>2 years</option>
                                <option>3 years</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="width: 100px;">Save</button>
                        <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/certification/moderate.js') }}"></script>
@endsection
