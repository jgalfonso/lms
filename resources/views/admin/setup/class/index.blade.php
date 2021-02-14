@extends('admin.template')

@section('title', 'Class')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Class</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right">
	    <a href="{{ url('admin/setup/class/new') }}" class="btn btn-new btn-sm btn-primary" title="New Page">New class</a>
	</div>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <label>Filter by Course:</label>
                            <div class="input-group">
                                <select class="form-control" id="classes">
                                    <option value="">Choose...</option>
                                    <?php if (!empty($courses)): ?>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="{{ $course->course_id }}">{{ $course->name }}</option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="dt">
                         <thead>
                            <tr>
                                <th class="text-center th-mark">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </th>
                                <th>Class Code / Name</th>
                                <th>Course</th>
                                <th>Instructor</th>
                                <th class="th-status">Status</th>
                                <th class="text-center th-action"><i class="fa fa-level-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </td>
                                <td><b>J0427QM52Z</b><br/><a href="">Social Media Community Manager For Women’s <br/>Fashion Brand</a></td>

                                <td>
                                    <div class="font-15">Computing Fundamentals</div>
                                </td>
                                  <td>Marshall Nichols</td>
                                <td >Active</td>
                                <td >
                                      <button type="button" class="btn btn-sm btn-default btn-edit" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </td>
                                <td><b>XOPSDDEEE</b><br/><a href="">What Is Animation?</a></td>

                                <td>
                                    <div class="font-15">Computer Programming I (Imperative)</div>
                                </td>
                               <td>Susie Willis</td>
                                 <td >New</td>
                                 <td >
                                      <button type="button" class="btn btn-sm btn-default btn-edit" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox"><span></span></label>
                                    </div>
                                </td>
                                <td><b>B2O6W788D8</b><br/><a href="">What Is an Algorithm?</a></td>

                                <td>
                                    <div class="font-15">Information Management</div>
                                </td>
                                 <td>Francisco Vasquez</td>
                                 <td >New</td>
                                <td >
                                      <button type="button" class="btn btn-sm btn-default btn-edit" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="icon-pencil"></i></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="row action-mark">
                    <div class="col-md-12">
                        <button class="btn btn-success btn-mark" type="button">Mark as Active</button>
                        <button class="btn btn-danger btn-mark" type="button">Mark as Closed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/projects/archives.js') }}"></script>
@endsection
