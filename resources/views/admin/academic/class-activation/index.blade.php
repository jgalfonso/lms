@extends('admin.template')

@section('title', 'Class Activation')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Class Activation</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
<div id="alert"></div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card card-search">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-10 col-md-6">
                            <label>Name / Class Code:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 col-md-6">
                            <div class="input-group">
                                <input id="search" type="text" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <button id="search" type="button" class="btn btn-sm btn-info btn-block btn-search">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="header">
                    <h2>Pending Activation <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="dt">
                         <thead>
                            <tr>
                                <th class="text-center th-mark">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Class Code / Name</th>
                                <th>Instructor</th>
                                <th class="th-status">Weight</th>
                                <th class="th-status">Units</th>
                                <th class="th-status">Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </td>
                                <td>Alfonso, Jerald De Guzman</td>
                                <td><b>J0427QM52Z</b><br/><a href="">Computing Fundamentals</a></td>
                                <td>
                                    <div class="font-15">Marshall Nichols</div>
                                </td>

                                <td class="text-center"><span class="badge badge-success text-uppercase">Major</span></td>
                                <td class="text-right">8</td>
                                <td ><strong>MWF</strong></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </td>
                                <td>Muriel, Joyce</td>
                                <td><b>XOPSDDEEE</b><br/><a href="">Computer Programming I (Imperative)</a></td>
                                <td>
                                    <div class="font-15">Francisco Vasquez</div>
                                </td>
                                <td class="text-center"><span class="badge badge-warning text-uppercase">Minor</span></td>
                                <td class="text-right">3</td>
                                <td><strong>TTH</strong></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </td>
                                <td>Quiambao, Ann</td>
                                <td><b>B2O6W788D8</b><br/><a href="">Information Management</a></td>
                                <td>
                                    <div class="font-15">Susie Willis</div>
                                </td>
                                <td class="text-center"><span class="badge badge-success text-uppercase">Major</span></td>
                                <td class="text-right">5</td>
                                <td><strong>MWF</strong></td>
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

                <div class="row action-mark mt-2" style="float: left;">
                    <div class="col-md-12">
                        <button class="btn btn-success" type="button">Accept</button>
                        <button class="btn btn-danger" type="button">Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/class-activation/archive.js') }}"></script>
@endsection
