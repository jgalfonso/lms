@extends('admin.template')

@section('title', 'Users - Students - New')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
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

        <form id="form" method="post" novalidate>
            <div class="col-lg-12">
                <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                <a href="/admin/manage-users/students" class="btn btn-danger" style="width: 100px;">Cancel</a>
            </div> 

            <div class="col-lg-12" style="margin-top: 15px;">
                <div class="card">
                    <div class="header">
                        <h2>Basic Information </h2>
                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Registration No.</label><span style="color: red"> * </span>
                                    <input name="registrationNo" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Reference No.</label><span style="color: red"> * </span>
                                     <input name="referenceNo" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-6"></div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Lastname</label><span style="color: red"> * </span>
                                    <input name="lastname" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Firstname</label><span style="color: red"> * </span>
                                    <input name="firstname" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Middlename</label>
                                    <input name="middlename" type="text" class="form-control" >
                                </div>
                            </div>

                             <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Suffix</label>
                                    <input name="suffix" type="text" class="form-control" >
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>DOB</label><span style="color: red"> * </span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input name="dob" type="text" data-date-autoclose="true" class="form-control dob" data-parsley-errors-container="#dob-errors" required>
                                    </div>
                                    <div id="dob-errors" style="margin-top: -7px;"></div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label>Place of Birth</label>
                                    <input name="pob" type="text" class="form-control" >
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Gender</label><span style="color: red"> * </span>
                                    <select name="gender" class="form-control" required>
                                        <option value="" selected="">Choose...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Civil Status</label><span style="color: red"> * </span>
                                    <select name="civilStatus" class="form-control" required>
                                        <option value="" selected="">Choose...</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Height</label>
                                    <input name="height" type="text" class="form-control" >
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input name="weight" type="text" class="form-control" >
                                </div>
                            </div>

                             <div class="col-lg-6">
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Color of Eyes</label>
                                    <input name="eyeColor" type="text" class="form-control" >
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Color of Hair</label>
                                    <input name="hairColor" type="text" class="form-control" >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Distiguishing Marks</label>
                                    <input name="marks" type="text" class="form-control" >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label><span style="color: red"> * </span>
                                    <input name="email" type="email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">   
                <div class="row"> 
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#contact-information">Contact Information</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#education-background">Education Background</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#employment-history">Employment History</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#certificates">Certificate & Credentials</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#avatar">Avatar</a></li>
                        </ul> 
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="contact-information">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Contact Information</h2>
                                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                                    </div>

                                    <div class="body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Permanent Address</label><span style="color: red"> * </span>
                                                    <input name="permanentAddress" type="text" class="form-control" required >
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Present Address</label>
                                                    <input name="presentAddress"  type="text" class="form-control" >
                                                </div>
                                            </div>

                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Mobile No. 1</label>
                                                    <input name="mobile1" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Mobile No. 2</label>
                                                    <input name="mobile2" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Phone No. 1</label>
                                                    <input name="phone1" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Phone No. 2</label>
                                                    <input name="phone2" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                            </div>

                                            <div class="col-lg-12">
                                                <h6 style="margin-top: 15px;">Emergency Contact</h6>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input name="ecName" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input name="ecAddress" type="text" class="form-control" >
                                                </div>
                                            </div>

                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Contact No.</label>
                                                    <input name="ecContact" type="text" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="education-background">
                        <div class="row">
                            <div class="col-lg-12">    
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Education Background</h2>
                                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                                    </div>

                                    <div class="body education-background" style="margin-bottom: 15px;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Name of School</label><span style="color: red"> * </span>
                                                    <input name="eb_name[]" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <label class="float-right"><a href="javascript:void(0);" class="remove-education-background hidden">Remove </a></label>
                                                    <input name="eb_address[]" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Course</label>
                                                    <input name="eb_course[]" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>From</label>
                                                    <select name="eb_from[]" class="form-control">
                                                        <option value="" selected="">Choose...</option>

                                                        @foreach(range(date('Y')-21, date('Y')) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>To</label>
                                                    <select name="eb_to[]" class="form-control">
                                                        <option value="" selected="">Choose...</option>

                                                        @foreach(range(date('Y')-21, date('Y')) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                             <div class="col-lg-12">
                                                <div class="text-right">
                                                    <button id="add-education-background" type="button" class="btn btn-default"> <i class="fa fa-plus"></i> Add Education</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="employment-history">
                        <div class="row">
                            <div class="col-lg-12">    
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Employment History</h2>
                                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                                    </div>

                                     <div class="body employment-history" style="margin-bottom: 15px;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Company/Bussiness Name</label><span style="color: red"> * </span>
                                                    <input name="eh_name[]" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <label class="float-right"><a href="javascript:void(0);" class="remove-employment-history hidden">Remove </a></label>
                                                    <input name="eh_address[]" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Position</label>
                                                    <input name="eh_position[]" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Contact</label>
                                                    <input name="eh_contact[]" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>From</label>
                                                     <select name="eh_from_month[]" class="form-control">
                                                        <option value="" selected="">Choose...</option>
                                                        <option value="January">January</option>
                                                        <option value="February">February</option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp</label>
                                                     <select name="eh_from_year[]" class="form-control">
                                                        <option value="" selected="">Choose...</option>

                                                        @foreach(range(date('Y')-21, date('Y')) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>To</label>
                                                     <select name="eh_to_month[]" class="form-control">
                                                        <option value="" selected="">Choose...</option>
                                                        <option value="January">January</option>
                                                        <option value="February">February</option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp</label>
                                                    <select name="eh_to_year[]" class="form-control">
                                                        <option value="" selected="">Choose...</option>

                                                        @foreach(range(date('Y')-21, date('Y')) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                             <div class="col-lg-12">
                                                <div class="text-right">
                                                    <button id="add-employment-history" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add Employment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="certificates"> 
                        <div class="row">
                            <div class="col-lg-12">    
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Certificate & Credentials</h2>
                                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                                    </div>

                                     <div class="body certificates" style="margin-bottom: 15px;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>School/Organization Name</label><span style="color: red"> * </span>
                                                    <input name="c_name[]" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <label class="float-right"><a href="javascript:void(0);" class="remove-certificates hidden">Remove </a></label>
                                                    <input name="c_address[]" type="text" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Title</label><span style="color: red"> * </span>
                                                    <input name="c_title[]" type="text" class="form-control" required>
                                                </div>
                                            </div> 

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Control No.</label><span style="color: red"> * </span>
                                                    <input name="c_control_no[]" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <select name="c_date_month[]"  class="form-control">
                                                        <option value="" selected="">Choose...</option>
                                                        <option value="January">January</option>
                                                        <option value="February">February</option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>&nbsp</label>
                                                     <select name="c_date_year[]" class="form-control">
                                                        <option value="" selected="">Choose...</option>

                                                        @foreach(range(date('Y')-21, date('Y')) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                             <div class="col-lg-12">
                                                <div class="text-right">
                                                    <button id="add-certificates" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add Certificate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="avatar">
                        <div class="row">
                            <div class="col-lg-12">    
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Avatar</h2>
                                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                                    </div>

                                     <div class="body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Filename</label>
                                                    <div class="custom-file">
                                                        <input name="file" type="file" class="form-control" style="padding: 3px 0 0 3px;" accept="image/x-png,image/gif,image/jpeg">
                                                    </div>
                                                </div>

                                                <small class="small-text">Images must be JPEG and 100kb to 10mb in file size</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">    
                <div style="padding-bottom: 3%;">
                    <button type="button" href="" class="btn btn-success save" style="width: 100px;">Save</button>
                    <a href="/admin/manage-users/students" class="btn btn-danger" style="width: 100px">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/users/faculty-new.js') }}"></script>
@endsection
