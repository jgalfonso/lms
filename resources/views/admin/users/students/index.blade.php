@extends('admin.template')

@section('title', 'Users - Students')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Students</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right hidden-xs">
        <a href="{{ route('students-new') }}" class="btn btn-sm btn-primary" title="" style="width: 100px">Add New</a>
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
                            <th></th>
                            <th style="width: 1%;"></th>
                            <th>Name</th>
                            <th style="width: 10%;">Student No.</th>
                            <th style="width: 10%;">Dob</th>
                            <th style="width: 10%;">Age</th>
                            <th style="width: 10%;">Gender</th>
                            <th style="width: 1%;"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $row)
                            <tr>
                                <td>{{ $row->profile_id }}</td>
                                <td>
                                    @if ($row->meta && $row->filename)
                                        <img src="{{ URL::asset(json_decode($row->meta)->thumb[0]->path . $row->filename) }}" class="avtar-pic w35" alt="Avatar">
                                    @else
                                        <div class=@if($row->gender == 'Male') "avtar-pic w35 bg-blue" @else "avtar-pic w35 bg-pink" @endif data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name"><span>{{ substr($row->firstname, 0, 1).substr($row->lastname, 0, 1) }}</span></div></td>
                                    @endif 
                                <td><a href="{{ route('students-view', $row->profile_id) }}">{{ $row->firstname. ($row->middlename ? ' '.$row->middlename.' ' : ' '). $row->lastname }}</a><br />{{ $row->email }}</td>
                                <td>{{ $row->reference_no }}</td>
                                <td>{{ $row->dob }}</td>
                                <td>{{ $row->age }}</td>
                                <td>{{ $row->gender }}</td>
                                <td class="align-center"><a href="{{ route('students-edit', $row->profile_id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/users/students.js') }}"></script>
@endsection
