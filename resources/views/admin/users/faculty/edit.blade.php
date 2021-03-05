@extends('admin.template')

@section('title', 'Users - Faculty (Edit)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.css') }}">

    <style type="text/css">
        .parsley-errors-list {
            width: 100%;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Edit</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate>
            <div class="col-lg-12">
                <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
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
                                    <label>Faculty No.</label>
                                    <input type="text" class="form-control" readonly value="{{ $faculty->control_no }}" style="font-weight: bold;">
                                </div>
                            </div>

                            <div class="col-lg-9">
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Registration No.</label><span style="color: red"> * </span>
                                    <input name="registrationNo" type="text" class="form-control" required value="{{ $faculty->registration_no }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Reference No.</label><span style="color: red"> * </span>
                                     <input name="referenceNo" type="text" class="form-control" required value="{{ $faculty->reference_no }}">
                                </div>
                            </div>

                            <div class="col-lg-6"></div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Lastname</label><span style="color: red"> * </span>
                                    <input name="lastname" type="text" class="form-control" required value="{{ $faculty->lastname }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Firstname</label><span style="color: red"> * </span>
                                    <input name="firstname" type="text" class="form-control" required value="{{ $faculty->firstname }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Middlename</label>
                                    <input name="middlename" type="text" class="form-control" value="{{ $faculty->middlename }}">
                                </div>
                            </div>

                             <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Suffix</label>
                                    <input name="suffix" type="text" class="form-control" value="{{ $faculty->suffix }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>DOB</label><span style="color: red"> * </span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input name="dob" type="text" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" required value="{{ date('d/m/Y', strtotime($faculty->dob)) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label>Place of Birth</label>
                                    <input name="pob" type="text" class="form-control" value="{{ $faculty->pob }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Gender</label><span style="color: red"> * </span>
                                    <select name="gender" class="form-control" required>
                                        <option value="" selected="">Choose...</option>
                                        <option @if($faculty->gender == 'Male') selected @endif value="Male">Male</option>    
                                        <option @if($faculty->gender == 'Female') selected @endif value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Civil Status</label><span style="color: red"> * </span>
                                    <select name="civilStatus" class="form-control" required>
                                        <option value="" selected="">Choose...</option>
                                        <option @if($faculty->civil_status == 'Single') selected @endif value="Single">Single</option>
                                        <option @if($faculty->civil_status == 'Married') selected @endif value="Married">Married</option>
                                        <option @if($faculty->civil_status == 'Divorced') selected @endif value="Divorced">Divorced</option>
                                        <option @if($faculty->civil_status == 'Widowed') selected @endif value="Widowed">Widowed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Height</label>
                                    <input name="height" type="text" class="form-control" value="{{ $faculty->height }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input name="weight" type="text" class="form-control" value="{{ $faculty->weight }}">
                                </div>
                            </div>

                             <div class="col-lg-6">
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Color of Eyes</label>
                                    <input name="eyeColor" type="text" class="form-control" value="{{ $faculty->eye_color }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Color of Hair</label>
                                    <input name="hairColor" type="text" class="form-control" value="{{ $faculty->hair_color }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Distiguishing Marks</label>
                                    <input name="marks" type="text" class="form-control" value="{{ $faculty->marks }}">
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
                                                    <input name="permanentAddress" type="text" class="form-control" required value="{{ $faculty->permanent_address }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Present Address</label>
                                                    <input name="presentAddress"  type="text" class="form-control" value="{{ $faculty->present_address }}">
                                                </div>
                                            </div>

                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Mobile No. 1</label>
                                                    <input name="mobile1" type="text" class="form-control" value="{{ $faculty->mobile_no1 }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Mobile No. 2</label>
                                                    <input name="mobile2" type="text" class="form-control" value="{{ $faculty->mobile_no2 }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Phone No. 1</label>
                                                    <input name="phone1" type="text" class="form-control" value="{{ $faculty->phone_no1 }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Phone No. 2</label>
                                                    <input name="phone2" type="text" class="form-control" value="{{ $faculty->phone_no2 }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email</label><span style="color: red"> * </span>
                                                    <input name="email" type="email" class="form-control" required value="{{ $faculty->email }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <h6 style="margin-top: 15px;">Emergency Contact</h6>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input name="ecName" type="text" class="form-control" value="{{ $faculty->ec_name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input name="ecAddress" type="text" class="form-control" value="{{ $faculty->ec_address }}">
                                                </div>
                                            </div>

                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Contact No.</label>
                                                    <input name="ecContact" type="text" class="form-control" value="{{ $faculty->ec_contact_no }}">
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

                                    @for ($i = 0; $i < count($education_background); $i++)
                                        <div class="body @if(($i+1) == count($education_background)) education-background @endif" style="margin-bottom: 15px;">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Name of School</label><span style="color: red"> * </span>
                                                        <input name="eb_name[]" type="text" class="form-control" required value="{{ $education_background[$i]->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <label class="float-right"><a href="javascript:void(0);" class="remove-education-background @if(($i+1) == count($education_background)) hidden @endif">Remove </a></label>
                                                        <input name="eb_address[]" type="text" class="form-control" value="{{ $education_background[$i]->address }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Course</label>
                                                        <input name="eb_course[]" type="text" class="form-control" value="{{ $education_background[$i]->course }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                        <select name="eb_from[]" class="form-control">
                                                            <option value="" selected="">Choose...</option>

                                                            @foreach(range(date('Y')-21, date('Y')) as $year)
                                                                <option @if($education_background[$i]->from == $year) selected @endif value="{{$year}}">{{$year}}</option>
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
                                                                <option @if($education_background[$i]->to == $year) selected @endif value="{{$year}}">{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                 <div class="col-lg-12">
                                                    <div class="text-right">
                                                        @if(($i+1) == count($education_background))
                                                            <button id="add-education-background" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add Education</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
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

                                    @for ($i = 0; $i < count($employment_history); $i++)
                                        <div class="body @if(($i+1) == count($employment_history)) employment-history @endif" style="margin-bottom: 15px;">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Company/Bussiness Name</label><span style="color: red"> * </span>
                                                        <input name="eh_name[]" type="text" class="form-control" required value="{{ $employment_history[$i]->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <label class="float-right"><a href="javascript:void(0);" class="remove-employment-history @if(($i+1) == count($employment_history)) hidden @endif">Remove </a></label>
                                                        <input name="eh_address[]" type="text" class="form-control" value="{{ $employment_history[$i]->address }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Position</label>
                                                        <input name="eh_position[]" type="text" class="form-control" value="{{ $employment_history[$i]->position }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Contact</label>
                                                        <input name="eh_contact[]" type="text" class="form-control" value="{{ $employment_history[$i]->contact }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                         <select name="eh_from_month[]" class="form-control">
                                                            <option value="" selected="">Choose...</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'January') selected @endif value="January">January</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'February') selected @endif value="February">February</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'March') selected @endif value="March">March</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'April') selected @endif value="April">April</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'May') selected @endif value="May">May</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'June') selected @endif value="June">June</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'July') selected @endif value="July">July</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'August') selected @endif value="August">August</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'September') selected @endif value="September">September</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'October') selected @endif value="October">October</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'November') selected @endif value="November">November</option>
                                                            <option @if(explode(' ', $employment_history[$i]->from)[0]  == 'December') selected @endif value="December">December</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>&nbsp</label>
                                                         <select name="eh_from_year[]" class="form-control">
                                                            <option value="" selected="">Choose...</option>

                                                            @foreach(range(date('Y')-21, date('Y')) as $year)
                                                                <option @if(explode(' ', $employment_history[$i]->from)[1]  == $year)) selected @endif value="{{$year}}">{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>To</label>
                                                         <select name="eh_to_month[]" class="form-control">
                                                            <option value="" selected="">Choose...</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'January') selected @endif value="January">January</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'February') selected @endif value="February">February</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'March') selected @endif value="March">March</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'April') selected @endif value="April">April</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'May') selected @endif value="May">May</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'June') selected @endif value="June">June</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'July') selected @endif value="July">July</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'August') selected @endif value="August">August</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'September') selected @endif value="September">September</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'October') selected @endif value="October">October</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'November') selected @endif value="November">November</option>
                                                            <option @if(explode(' ', $employment_history[$i]->to)[0]  == 'December') selected @endif value="December">December</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>&nbsp</label>
                                                        <select name="eh_to_year[]" class="form-control">
                                                            <option value="" selected="">Choose...</option>

                                                            @foreach(range(date('Y')-21, date('Y')) as $year)
                                                                <option @if(explode(' ', $employment_history[$i]->to)[1]  == $year)) selected @endif value="{{$year}}">{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                 <div class="col-lg-12">
                                                    <div class="text-right">
                                                        @if(($i+1) == count($employment_history))
                                                            <button id="add-employment-history" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add Employment</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
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

                                    @for ($i = 0; $i < count($credentials); $i++)
                                        <div class="body @if(($i+1) == count($credentials)) certificates @endif" style="margin-bottom: 15px;">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>School/Organization Name</label><span style="color: red"> * </span>
                                                        <input name="c_name[]" type="text" class="form-control" required value="{{ $credentials[$i]->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <label class="float-right"><a href="javascript:void(0);" class="remove-certificates @if(($i+1) == count($credentials)) hidden @endif">Remove </a></label>
                                                        <input name="c_address[]" type="text" class="form-control" value="{{ $credentials[$i]->address }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Title</label><span style="color: red"> * </span>
                                                        <input name="c_title[]" type="text" class="form-control" required value="{{ $credentials[$i]->title }}">
                                                    </div>
                                                </div> 

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Control No.</label><span style="color: red"> * </span>
                                                        <input name="c_control_no[]" type="text" class="form-control" required value="{{ $credentials[$i]->reference_no }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Date</label>
                                                        <select name="c_date_month[]"  class="form-control">
                                                            <option value="" selected="">Choose...</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'January') selected @endif value="January">January</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'February') selected @endif value="February">February</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'March') selected @endif value="March">March</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'April') selected @endif value="April">April</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'May') selected @endif value="May">May</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'June') selected @endif value="June">June</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'July') selected @endif value="July">July</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'August') selected @endif value="August">August</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'September') selected @endif value="September">September</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'October') selected @endif value="October">October</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'November') selected @endif value="November">November</option>
                                                            <option @if(explode(' ', $credentials[$i]->date_issued)[0]  == 'December') selected @endif value="December">December</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>&nbsp</label>
                                                         <select name="c_date_year[]" class="form-control">
                                                            <option value="" selected="">Choose...</option>

                                                            @foreach(range(date('Y')-21, date('Y')) as $year)
                                                                <option @if(explode(' ', $credentials[$i]->date_issued)[1]  == $year)) selected @endif value="{{$year}}">{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                 <div class="col-lg-12">
                                                    <div class="text-right">
                                                        @if(($i+1) == count($credentials))
                                                            <button id="add-certificates" type="button" class="btn btn-default btn-new"> <i class="fa fa-plus"></i> Add Certificate</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
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

            <input name="profileID" type="hidden" value="{{ $faculty->profile_id }}">  
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/users/faculty-edit.js') }}"></script>
@endsection
