@extends('admin.template')

@section('title', 'Search')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Search</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right">
	    <a href="{{ url('admin/services/enrollment/new') }}" class="btn btn-new btn-sm btn-primary" title="New Enrollment">New Enrollment</a>
	</div>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card" style="margin-bottom: 15px;">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <label>Name / Student No:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 text-right">
                             <label>&nbsp;</label>
                            <a href="javascript:void(0);" class="btn btn-primary btn-block" title="" style="width: 100px">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 1%;"></th>
                            <th>Name</th>
                            <th style="width: 10%;">Student No.</th>
                            <th style="width: 10%;">Dob</th>
                            <th style="width: 10%;">Age</th>
                            <th style="width: 10%;">Gender</th>
                            <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td ><img src="assets/images/avatar.jpg" class="avtar-pic w35" alt="Avatar"></td>
                            <td><a href="">Marshall Nichols</a><br>marshall-n@gmail.com</td>
                            <td>S1000000001</td>
                            <td>21 October 1990</td>
                            <td>30</td>
                            <td>Female</td>
                            <td class="align-center">
                                <a  href="services-enrollment-enroll_student-add_class.html" title="Enroll & Add Class" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>

                            </td>
                        </tr>
                        <tr>
                            <td><div class="avtar-pic w35 bg-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name"><span>DS</span></div></td>
                            <td><a href="">Debra Stewart</a><br>debra@gmail.com</td>
                            <td>S1000000002</td>
                            <td>16 May 1995</td>
                            <td>15</td>
                            <td>Female</td>
                            <td class="align-center">
                                <a  href="services-enrollment-enroll_student-add_class.html" title="Enroll & Add Class" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>

                            </td>
                        </tr>
                        <tr>
                            <td ><div class="avtar-pic w35 bg-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name"><span>EG</span></div></td>
                            <td><a href="">Erin Gonzales</a><br>erinonzales@gmail.com</td>
                            <td>S1000000003</td>
                            <td>12 October 1995</td>
                            <td>15</td>
                            <td>Male</td>
                            <td class="align-center">
                                <a  href="services-enrollment-enroll_student-add_class.html" title="Enroll & Add Class" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>

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
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/projects/archives.js') }}"></script>
@endsection
