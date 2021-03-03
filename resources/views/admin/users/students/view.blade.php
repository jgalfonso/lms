@extends('admin.template')

@section('title', 'Users - Students (Student No.: '.$student->control_no.')')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Student No.: {{ $student->control_no }}</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate>
            <div class="col-lg-12">
                <a href="{{ route('students-edit', $student->profile_id) }}" class="btn btn-success" style="width: 100px;">Edit</a>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>

                <div class="dropdown-menu" x-placement="bottom-start">
                    <a href="{{ route('enroll_student-new', $student->profile_id) }}" class="btn btn-new btn-default dropdown-item">Enroll Student</a>
                </div>
            </div> 

            <div class="col-lg-12" style="margin-top: 15px;">
                <div class="card">
                    <div class="header">
                        <h2>Basic Information </h2>
                        <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($student->meta && $student->filename)
                                    <img src="{{ URL::asset(json_decode($student->meta)->thumb[0]->path . $student->filename) }}" class="user-photo" alt="Avatar" style="width: 100%;">
                                @else
                                    <div class=@if($student->gender == 'Male') "avtar-pic w35 bg-blue" @else "avtar-pic w35 bg-pink" @endif data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name" style="width: 100%;     height: 169.16px; padding: 66px 0;"><span style="font-size: 70px;">{{ substr($student->firstname, 0, 1).substr($student->lastname, 0, 1) }}</span></div></td>
                                @endif 

                               
                            </div>

                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Student No.</label>
                                            <label class="block"><b>{{ $student->control_no }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-9">
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Registration No.</label>
                                            <label class="block"><b>{{ $student->registration_no }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Reference No.</label>
                                            <label class="block"><b>{{ $student->reference_no }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <label class="block"><b>{{ $student->course }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <label class="block"><b>{{ $student->lastname }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <label class="block"><b>{{ $student->firstname }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Middlename</label>
                                            <label class="block">{{ $student->middlename }}</label>
                                        </div>
                                    </div>

                                     <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Suffix</label>
                                            <label class="block">{{ $student->suffix }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>DOB</label>
                                            <label class="block">{{ date('d/m/Y', strtotime($student->dob)) }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>Place of Birth</label>
                                            <label class="block">{{ $student->pob }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <label class="block">{{ $student->gender }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Civil Status</label>
                                            <label class="block">{{ $student->civil_status }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Height</label>
                                            <label class="block">{{ $student->height }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Weight</label>
                                            <label class="block">{{ $student->weight }}</label>
                                        </div>
                                    </div>

                                     <div class="col-lg-6">
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Color of Eyes</label>
                                            <label class="block">{{ $student->eye_color }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Color of Hair</label>
                                            <label class="block">{{ $student->hair_color }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Distiguishing Marks</label>
                                            <label class="block">{{ $student->marks }}</label>
                                        </div>
                                    </div>  
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
                                                    <label>Permanent Address</label>
                                                    <label class="block">{{ $student->permanent_address }}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Present Address</label>
                                                    <label class="block">{{ $student->present_address }}</label>
                                                </div>
                                            </div>

                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Mobile No. 1</label>
                                                    <label class="block">{{ $student->mobile_no1 }}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Mobile No. 2</label>
                                                    <label class="block">{{ $student->mobile_no2 }}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Phone No. 1</label>
                                                    <label class="block">{{ $student->phone_no1 }}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Phone No. 2</label>
                                                    <label class="block">{{ $student->phone_no2 }}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <label class="block"><b>{{ $student->email }}</b></label>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <h6 style="margin-top: 15px;">Emergency Contact</h6>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <label class="block">{{ $student->ec_name }}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <label class="block">{{ $student->ec_address }}</label>
                                                </div>
                                            </div>

                                             <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Contact No.</label>
                                                    <label class="block">{{ $student->ec_contact_no }}</label>
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
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table id="myTable" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Name of School</th>
                                                                <th style="width: 40%;">Course</th>
                                                                <th style="width: 10%;">Year</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($education_background as $row)
                                                                <tr>
                                                                    <td><b>{{ $row->name }}</b><br>{{ $row->address }}</td>
                                                                    <td>{{ $row->course }}</td>
                                                                    <td>{{ $row->from }} - {{ $row->to }}</td>
                                                                </tr>
                                                            @endforeach   
                                                        </tbody>
                                                    </table>
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
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table id="myTable" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Company/Bussiness Name</th>
                                                                <th style="width: 20%;">Position</th>
                                                                <th style="width: 20%;">Contact</th>
                                                                <th style="width: 15%;">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             @foreach ($employment_history as $row)
                                                                 <tr>
                                                                    <td><b>{{ $row->name }}</b><br>{{ $row->address }}</td>
                                                                    <td>{{ $row->position }}</td>
                                                                    <td>{{ $row->contact }}</td>
                                                                    <td>{{ $row->from }} - {{ $row->to }}</td>
                                                                </tr>
                                                            @endforeach  
                                                        </tbody>
                                                    </table>
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
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table id="myTable" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>School/Organization Name</th>
                                                                <th style="width: 20%;">Title</th>
                                                                <th style="width: 20%;">Control No.</th>
                                                                <th style="width: 15%;">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             @foreach ($credentials as $row)
                                                                 <tr>
                                                                    <td><b>{{ $row->name }}</b><br>{{ $row->address }}</td>
                                                                    <td>{{ $row->title }}</td>
                                                                    <td>{{ $row->reference_no }}</td>
                                                                    <td>{{ $row->date_issued }}</td>
                                                                </tr>
                                                            @endforeach  
                                                        </tbody>
                                                    </table>
                                                </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
@endsection
