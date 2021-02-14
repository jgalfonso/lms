@extends('admin.template')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Dashboard</h1>

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
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/fullcalendarscripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/calendar2.js') }}"></script>
@endsection
