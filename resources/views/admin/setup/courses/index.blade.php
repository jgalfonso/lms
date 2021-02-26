@extends('admin.template')

@section('title', 'Courses')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Courses</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right">
	    <a href="{{ url('admin/setup/courses/new') }}" class="btn btn-new btn-sm btn-primary" title="New Page">New Course</a>
	</div>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="dt" class="table dataTable">
                         <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th style="width: 1%;"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $row)
                                <tr>
                                    <td>{{ $row->course_id }}</td>
                                    <td><a href="{{ route('courses-view', $row->course_id) }}">{{ $row->name }}</a></td>
                                    <td class="align-center"><a href="{{ route('courses-edit', $row->course_id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/setup/courses.js') }}"></script>
@endsection
