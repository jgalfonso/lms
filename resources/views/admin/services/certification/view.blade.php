@extends('admin.template')

@section('title', 'Certificate')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Certificate</h1>

        @include('admin.includes.breadcrumb')
    </div>

@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Certificate Information </h2>
                </div>

                <div class="body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table style="width: 100%">
                                        <tr>
                                            <td><b>Certificate No:</b> </td>
                                            <td style="width:50%">C-0001</td>
                                        </tr>
                                        <tr>
                                            <td><b>Registration No:</b></td>
                                            <td style="width:50%">R-0001</td>
                                        </tr>

                                        <tr>
                                            <td><b>Control No:</b></td>
                                            <td style="width:50%">Co-0001</td>
                                        </tr>
                                        <tr>
                                            <td><b>Issued To:</b></td>
                                            <td style="width:50%">Juan</td>
                                        </tr>
                                        <tr>
                                            <td><b>Issue Date:</b></td>
                                            <td style="width:50%">01/01/2021</td>
                                        </tr>
                                        <tr>
                                            <td><b>Class No:</b></td>
                                            <td style="width:50%">Cl-0001</td>
                                        </tr>
                                        <tr>
                                            <td><b>Certificate Status:</b></td>
                                            <td style="width:50%">Active</td>
                                        </tr>
                                        <tr>
                                            <td><b>Created By:</b></td>
                                            <td style="width:50%">John</td>
                                        </tr>
                                        <tr>
                                            <td><b>QA By:</b></td>
                                            <td style="width:50%">Peter</td>
                                        </tr>
                                        <tr>
                                            <td><b>Approved By:</b></td>
                                            <td style="width:50%">Simon</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-2">
                                        <img src="assets/images/avatar.jpg" class="stu-avatar" style="width: 700px;" alt="Avatar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"  style="float: left; margin-top:  10px">
                   <div class="col-md-12">
                       <a href="javascript:history.back()" class="btn btn-secondary" style="width: 100px">Back</a>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
