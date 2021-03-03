@extends('admin.template')

@section('title', 'Services - Enrollment (New)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.css') }}">
    
    <style type="text/css">
        .modal-body table th, .modal-body table td {
            background: #f6f7f9 !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>New</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <button type="button" class="btn btn-success enroll" style="width: 100px;">Enroll</button>
                <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
            </div> 

            <div class="col-lg-12" style="margin-top: 15px;">
                <div class="card">
                    <div class="header">
                        <h2>Student Information <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                    </div>

                    <div class="body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2" style="padding-left: 0;">
                                    @if ($profile->meta && $profile->filename)
                                        <img src="{{ URL::asset(json_decode($profile->meta)->thumb[0]->path . $profile->filename) }}" class="user-photo" alt="Avatar" style="width: 100%;">
                                    @else
                                        <div class=@if($profile->gender == 'Male') "avtar-pic w35 bg-blue" @else "avtar-pic w35 bg-pink" @endif data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name" style="width: 100%;     height: 180px; padding: 66px 0;"><span style="font-size: 70px;">{{ substr($profile->firstname, 0, 1).substr($profile->lastname, 0, 1) }}</span></div></td>
                                    @endif
                                </div>

                                <div class="col-md-10">
                                    <table style="width: 100%">
                                        <tr>
                                            <td  style="width:20%">Name</td>
                                            <td>: <a href=""><b>{{ $profile->lastname }}, {{ $profile->firstname }} {{ $profile->middlename }}</b></a></td>
                                        </tr>

                                        <tr>
                                            <td style="width:20%">Student No.</td>
                                            <td >: <b>{{ $profile->control_no }}</b></td>
                                        </tr>

                                        <tr>
                                            <td style="width:20%">Email</td>
                                            <td >: {{ $profile->email }}</td>
                                        </tr>

                                        <tr>
                                            <td style="width:2  0%">Dob</td>
                                            <td >: {{ date('d/m/Y', strtotime($profile->dob)) }}</td>
                                        </tr>

                                        <tr>
                                            <td style="width:2  0%">Age</td>
                                            <td >: {{ $profile->age }}</td>
                                        </tr>

                                        <tr>
                                            <td style="width:2  0%">Gender</td>
                                            <td >: {{ $profile->gender }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Classes Enrolled  <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                    </div>

                    <div class="table-responsive">
                        <table id="dt" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                            <thead>
                                <tr>
                                    <th class="hidden">Class ID</th>
                                    <th>Class</th>
                                    <th>Course</th>
                                    <th>Instructor</th>
                                    <th>Schedule</th>
                                    <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                         <button type="button" class="btn btn-default float-right" data-toggle="modal" data-target="#modal">Add Class</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  

            <div class="col-lg-12">    
                <div style="padding-bottom: 3%;">
                    <button type="button" href="" class="btn btn-success enroll" style="width: 100px;">Enroll</button>
                    <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
                </div>
            </div>

            <input id="profileID" type="hidden" value="{{ $profile->profile_id }}">  
            <input id="courseID" type="hidden" value="{{ $profile->course_id }}">  
        </form>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="max-width: 900px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding: 10px 0 10px 0">
                        <div id="modal-alert" class="col-lg-12" style="margin-bottom: -10px; margin-top: 10px;"></div>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="dtClass" class="table table-hover table-striped js-basic-example dataTable table-custom spacing5 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="hidden"></th>
                                            <th style="width: 1%;" class="text-center"> 
                                                <div class="fancy-checkbox">
                                                    <label><input type="checkbox" class="select-all"><span style="width: 1px;"></span></label>
                                                </div>
                                            </th>
                                            <th>Class</th>
                                            <th>Course</th>
                                            <th>Instructor</th>
                                            <th>Schedule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classes as $row)
                                            <tr>
                                                <td class="hidden">{{ $row->class_id }}</td>
                                                <td class="text-center">
                                                    <div class="fancy-checkbox">
                                                        <label><input type="checkbox" class="checkbox"><span style="width: 1px;"></span></label>
                                                    </div>
                                                </td>
                                                <td><b>{{ $row->code }}</b><br/><a href="/admin/setup/classes/view/{{ $row->class_id }}">{{ $row->name }}</a></td>
                                                <td>{{ $row->course }}</td>
                                                <td>{{ $row->instructor }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach                                       
                                    </tbody>
                                </table>
                           
                            </div>
                         </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary add" style="width: 100px;">Add</button>
                        <button type="button" data-dismiss="modal" class="btn btn-default" style="width: 100px;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/enrollment/new.js') }}"></script>
@endsection
