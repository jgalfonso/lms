@extends('admin.template')

@section('title', 'Services - Cerfifications (Moderations)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

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
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Trainee's</th>
                                                <th style="width: 10%">Assessor</th>
                                                <th style="width: 15%">Assessment Date</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($entries as $row)
                                                <tr>

                                                    <td><b>{{ $row->class_code }}</b><br/><a href="">{{ $row->class_name }}</a></td>
                                                    <td>{{ $row->course }}</td>
                                                    <td class="text-right"><a href="">{{ $row->enrollees }}</a></td>
                                                    <td>{{ $row->assessor }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($row->date_assessed)) }}</td>
                                                    <td class="align-center">
                                                        <a href="{{ route('certifications-moderate', $row->assessment_id) }}" title="Moderate" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Trainee's</th>
                                                <th style="width: 10%">Assessor</th>
                                                <th style="width: 10%">Assessment Date</th>
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

                <div class="tab-pane" id="approval">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                     <table id="tbl-approval" class="table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th style="width: 10%">Trainee's</th>
                                                <th style="width: 10%">Assessor</th>
                                                <th style="width: 10%">Assessment Date</th>
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

                <div class="tab-pane" id="active">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                     <table id="tbl-active" class="table dataTable">
                                        <thead>
                                            <tr>
                                                <th>Certificate ID</th>
                                                <th>Class No. / Name</th>
                                                <th style="width: 17%">Course</th>
                                                <th style="width: 17%">Trainee</th>
                                                <th style="width: 10%">Certification No.</th>
                                                <th style="width: 10%">Registration No.</th>
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
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/certification/moderations.js') }}"></script>
@endsection
