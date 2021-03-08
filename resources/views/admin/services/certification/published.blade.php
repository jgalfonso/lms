@extends('admin.template')

@section('title', 'Services - Cerfifications (Published)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Published</h1>

        @include('admin.includes.breadcrumb')
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
                                        <label>Filter by Name / Student No:</label>
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
                        </li>
                    </ul>
                </div>
            </div>
        </div>   

        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dt" class="table dataTable">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Authentication Code</th>
                            <th style="width: 10%;">Certification No.</th>
                            <th>Name</th>
                            <th style="width: 10%;">Date Released</th>
                            <th>Released By</th>
                            <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificates as $row)
                            <tr>
                                <td><a href="">{{ $row->authentication_code }}</a></td>
                                <td>{{ $row->certificate_no }}</td>
                                <td><b>{{ $row->control_no }}</b><br/><a href="{{ route('students-view', $row->profile_id) }}">{{ $row->trainee }}</a></td>
                                <td>{{ date('d/m/Y', strtotime($row->dt_released)) }}</td>
                                <td>Peter Simon</td>
                                <td class="align-center">
                                    <a href="{{ route('certifications-view', $row->certificate_id) }}" title="View" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/certification/published.js') }}"></script>
@endsection
