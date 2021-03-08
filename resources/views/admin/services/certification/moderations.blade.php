@extends('admin.template')

@section('title', 'Services - Cerfifications (Moderations)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <style type="text/css">
        .span-counter {
            background: #5CB65F;
            color: #fff;
            width: 30px;
            height: 30px;
            padding: 0px 3px;
            text-align: center;
            border-radius: 3px;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Moderations</h1>

        @include('admin.includes.breadcrumb')
    </div>

@endsection

@section('content')
    <div id="alert"></div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a name="new" class="nav-link tab active show" data-toggle="tab" href="#new">New Submitted <span class="span-counter">{{ $summary->new }}</span></a></li>
                        <li class="nav-item"><a name="qa" class="nav-link tab" data-toggle="tab" href="#qa">For Quality Assurance <span class="span-counter">{{ $summary->qa }}</span></a></li>
                        <li class="nav-item"><a name="approval" class="nav-link tab" data-toggle="tab" href="#approval">For Approval <span class="span-counter">{{ $summary->approval }}</span></a></li>
                        <li class="nav-item"><a name="rejected" class="nav-link tab" data-toggle="tab" href="#rejected">Rejected <span class="span-counter bg-red">{{ $summary->rejected }}</span></a></li>
                        <li class="nav-item"><a name="active" class="nav-link tab" data-toggle="tab" href="#active">Active <span class="span-counter bg-azura">{{ $summary->active }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="tab-content mt-0">
                <div class="tab-pane show active" id="new">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                     <table id="tbl-new" class="table dataTable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="width: 1%;">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" class="select-all"><span style="width: 1%;"></span>
                                                    </label>
                                                </th>  
                                                <th>Student No. / Name</th>
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Date Assessed</th>
                                                <th style="width: 10%">Date Issued</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($entries as $row)
                                                <tr>
                                                    <td>{{ $row->certificate_id }}</td>
                                                    <td>
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" class="checkbox"><span style="width: 1%;"></span>
                                                        </label>
                                                    </td>
                                                    <td><b>{{ $row->control_no }}</b><br/><a href="{{ route('students-view', $row->profile_id) }}">{{ $row->trainee }}</a></td>
                                                    <td><b>{{ $row->class_code }}</b><br/><a href="{{ route('classes-view', $row->class_id) }}">{{ $row->class_name }}</a></td>
                                                    <td>{{ $row->course }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($row->dt_issued)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($row->date_assessed)) }}</td>
                                                    <td class="align-center">
                                                        <a href="{{ route('certifications-moderate', $row->certificate_id) }}" title="Moderate" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row action-mark">
                                    <div class="col-md-12">
                                        <button class="btn btn-success mark-as-forqa" type="button" style="width: 120px;">For QA</button>
                                        <button class="btn btn-success mark-as-forapproval" type="button" style="width: 120px;">For Approval</button>
                                        <button class="btn btn-danger mark-as-reject" type="button" style="width: 120px;">Reject</button>
                                        <button class="btn btn-info mark-as-approved" type="button" style="width: 120px;">Approved</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="qa">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                      <table id="tbl-qa" class="table dataTable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="width: 1%;">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" class="select-all"><span style="width: 1%;"></span>
                                                    </label>
                                                </th>  
                                                <th>Student No. / Name</th>
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Date Assessed</th>
                                                <th style="width: 10%">Date Issued</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row action-mark">
                                    <div class="col-md-12">
                                        <button class="btn btn-success mark-as-forapproval" type="button" style="width: 120px;">For Approval</button>
                                        <button class="btn btn-danger mark-as-reject" type="button" style="width: 120px;">Reject</button>
                                        <button class="btn btn-info mark-as-approved" type="button" style="width: 120px;">Approved</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="approval">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                     <table id="tbl-approval" class="table dataTable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="width: 1%;">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" class="select-all"><span style="width: 1%;"></span>
                                                    </label>
                                                </th>  
                                                <th>Student No. / Name</th>
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Date Assessed</th>
                                                <th style="width: 10%">Date Issued</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row action-mark">
                                    <div class="col-md-12">
                                        <button class="btn btn-info mark-as-approved" type="button" style="width: 120px;">Approved</button>
                                        <button class="btn btn-danger mark-as-reject" type="button" style="width: 120px;">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="rejected">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                     <table id="tbl-rejected" class="table dataTable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="width: 1%;">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" class="select-all"><span style="width: 1%;"></span>
                                                    </label>
                                                </th>  
                                                <th>Student No. / Name</th>
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Date Assessed</th>
                                                <th style="width: 10%">Date Issued</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row action-mark">
                                    <div class="col-md-12">
                                        <button class="btn btn-success mark-as-reverttoqa" type="button" style="width: 130px;">Revert to Q.A.</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="active">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                     <table id="tbl-active" class="table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Student No. / Name</th>
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Certification No.</th>
                                                <th style="width: 10%">Registration No. </th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input id="current-tab" type="hidden" value="new">  
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/services/certification/moderations.js') }}"></script>
@endsection
