@extends('admin.template')

@section('title', 'Moderations')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
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
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#new">New Submitted <span class="span-counter" style="background: #5CB65F;
">3</span></a></li>
                        <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#qa">For Quality Assurance <span class="span-counter" style="background: #5CB65F;
">1</span></a></li>
                        <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#approval">For Approval <span class="span-counter" style="background: #5CB65F;
">2</span></a></li>
                        <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#active">Active <span class="span-counter bg-azura">3</span></a></li>
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
                                    <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                                        <thead>
                                            <tr>

                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th class="text-right" style="width: 10%">Trainee's</th>
                                                <th style="width: 10%">Assessor</th>
                                                <th style="width: 10%">Assessment Date</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td><b>J0427QM52Z</b><br/><a href="">Google IT Support Professional Certificate</a></td>
                                                 <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td class="text-right"><a href="">15</a></td>
                                                <td>Marshall Nichols</td>
                                                <td>03 Feb 2021</td>
                                                <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <tr>

                                                 <td><b>XOPSDDEEE</b><br/><a href="">Key Technologies for Business Specialization</a></td>
                                                <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td class="text-right"><a href="">15</a></td>
                                                <td>Susie Willis</td>
                                                <td>03 Feb 2021</td>
                                                 <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>

                                            <tr>

                                                 <td><b>B2O6W788D8</b><br/><a href="">Data Engineering Foundations Specialization</a></td>
                                                 <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td class="text-right"><a href="">15</a></td>
                                                <td>Susie Willis</td>
                                                <td>03 Feb 2021</td>
                                                  <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <ul class="pagination mt-2" style="float: right;" >
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="qa">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                      <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                                        <thead>
                                            <tr>

                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th class="text-right" style="width: 10%">Trainee's</th>
                                                <th style="width: 10%">Assessor</th>
                                                <th style="width: 10%">Assessment Date</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td><b>J0427QM52Z</b><br/><a href="">Google IT Support Professional Certificate</a></td>
                                                 <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td class="text-right"><a href="">15</a></td>
                                                <td>Marshall Nichols</td>
                                                <td>03 Feb 2021</td>
                                                <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <ul class="pagination mt-2" style="float: right;" >
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="approval">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                     <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                                        <thead>
                                            <tr>

                                                <th>Class No. / Name</th>
                                                <th>Course</th>
                                                <th class="text-right" style="width: 10%">Trainee's</th>
                                                <th style="width: 10%">Assessor</th>
                                                <th style="width: 10%">Assessment Date</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td><b>J0427QM52Z</b><br/><a href="">Google IT Support Professional Certificate</a></td>
                                                 <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td class="text-right"><a href="">15</a></td>
                                                <td>Marshall Nichols</td>
                                                <td>03 Feb 2021</td>
                                                <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <tr>

                                                 <td><b>XOPSDDEEE</b><br/><a href="">Key Technologies for Business Specialization</a></td>
                                                <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td class="text-right"><a href="">15</a></td>
                                                <td>Susie Willis</td>
                                                <td>03 Feb 2021</td>
                                                 <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>

                                <ul class="pagination mt-2" style="float: right;" >
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="active">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="table-responsive">
                                     <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                                        <thead>
                                            <tr>

                                                <th>Class No. / Name</th>
                                                <th style="width: 17%">Course</th>
                                                <th style="width: 17%">Trainee</th>
                                                <th style="width: 10%">Certification No.</th>
                                                <th style="width: 10%">Registration No.</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td><b>J0427QM52Z</b><br/><a href="">Google IT Support Professional Certificate</a></td>
                                                 <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td>Marshall Nichols</td>
                                                <td>CT-000000001</td>
                                                <td>RG-000000001</td>
                                                <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <tr>

                                                 <td><b>XOPSDDEEE</b><br/><a href="">Key Technologies for Business Specialization</a></td>
                                                <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td>Susie Willis</td>
                                                 <td>CT-000000002</td>
                                                 <td>RG-000000002</td>
                                                 <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>

                                            <tr>

                                                 <td><b>B2O6W788D8</b><br/><a href="">Data Engineering Foundations Specialization</a></td>
                                                 <td>
                                                    <div class="font-15">Information Technology</div>
                                                </td>
                                                <td>Susie Willis</td>
                                                 <td>CT-000000003</td>
                                                 <td>RG-000000003</td>
                                                  <td class="align-center">
                                                    <a  href="{{ route('process') }}" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <ul class="pagination mt-2" style="float: right;" >
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                </ul>
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
    <script src="{{ URL::asset('admin/js/projects/archives.js') }}"></script>
@endsection
