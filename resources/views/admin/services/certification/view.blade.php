@extends('admin.template')

@section('title', 'Services - Cerfifications (Certificate)')

@section('css')
    
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
                    <h2>Certificate Information <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                </div>

                <div class="body">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table style="width: 100%">
                                        <tr>
                                            <td style="width:35%">Certificate No.</td>
                                            <td>: <b>{{ $certificate->certificate_no }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Registration No.</td>
                                            <td>: {{ $certificate->registration_no }}</td>
                                        </tr>

                                        <tr>
                                            <td>Issued To</td>
                                            <td>: <a href="{{ route('students-view', $certificate->profile_id) }}">{{ $certificate->trainee }}</a></td>
                                        </tr>

                                        <tr>
                                            <td>Issue Date</td>
                                            <td>: {{ date('d/m/Y', strtotime($certificate->dt_created)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Class</td>
                                            <td>: <a href="{{ route('classes-view', $certificate->class_id) }}">{{ $certificate->class_name }}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>: {{ $certificate->status }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-lg-12">
                                    <hr style="border: 1px solid #e1e8ed;" />
                                </div>

                                <div class="col-lg-12">
                                    <p><b>Moderations:</b></p>

                                    @if(count($moderations))
                                        <ul style="list-style-type:circle; margin-bottom: 0; padding-inline-start: 20px;">
                                            @foreach ($moderations as $row)
                                                <li class="mb-2">
                                                    Moderated by <strong><a href="{{ route('faculty-view', $row->created_by) }}">{{ $row->moderator }}</a></strong>
                                                   {{ \Carbon\Carbon::parse($row->dt_created)->diffForHumans() }}.
                                                    (<strong class="text-green">{{ $row->grade }}</strong>) 
                                                    <br>
                                                    Remarks: <small>{{ $row->remarks }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img src="/assets/images/avatar.jpg" class="stu-avatar" style="width: 100%;" alt="Avatar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"  style="float: left; margin-top:  10px">
                   <div class="col-md-12">
                        <button type="button" class="btn btn-success save" style="width: 100px;">Print</button>
                        <button type="button" onclick="history.back();" class="btn btn-secondary" style="width: 100px;">Back</button>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
