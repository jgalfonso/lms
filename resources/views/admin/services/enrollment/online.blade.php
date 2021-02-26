@extends('admin.template')

@section('title', 'Services - Enrollment (Online Registration)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Online Registration</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right hidden-xs">
        <a href="/admin/manage-users/students/new" class="btn btn-sm btn-primary" title="" style="width: 100px">Add New</a>
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/users/students.js') }}"></script>
@endsection
