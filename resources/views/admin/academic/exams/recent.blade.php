@extends('admin.template')

@section('title', 'Exams')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Exams</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-6">
                                    <label>Filter by Class:</label>
                                    <div class="input-group">
                                        <select class="form-control">
                                            <option selected="">Choose...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-6">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                 <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%;">
                                            <div class="fancy-checkbox">
                                                <label><input type="checkbox"><span></span></label>
                                            </div>
                                        </th>
                                        <th>Title</th>
                                        <th>Availability</th>
                                        <th>Due Date</th>
                                        <th style="width: 10%; ">Time Limit</th>
                                        <th style="width: 1%; " class="text-center"><i class="fa fa-level-down"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <div class="fancy-checkbox">
                                                <label><input type="checkbox"><span></span></label>
                                            </div>
                                        </td>
                                        <td>Quiz Bee</td>
                                        <td>01/01/2021</td>
                                        <td>1 hr</td>
                                        <td >Active</td>
                                        <td>
                                              <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></button>
                                              <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="fancy-checkbox">
                                                <label><input type="checkbox"><span></span></label>
                                            </div>
                                        </td>
                                        <td>Sci Bee</td>
                                        <td>01/01/2021</td>
                                        <td>1 hr</td>
                                        <td >Active</td>
                                        <td>
                                              <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></button>
                                              <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <div class="fancy-checkbox">
                                                <label><input type="checkbox"><span></span></label>
                                            </div>
                                        </td>
                                        <td>Math Bee</td>
                                        <td>01/01/2021</td>
                                        <td>1 hr</td>
                                        <td >Active</td>
                                        <td>
                                              <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></button>
                                              <button type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-trash"></i></button>
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

                         <div class="row "  style="float: left; margin-top:  10px">
                            <div class="col-md-12">
                                <button class="btn btn-success" type="button">Mark as Active</button> <button class="btn btn-danger" type="button">Mark as Closed</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/js/exams/new.js') }}"></script>
@endsection
