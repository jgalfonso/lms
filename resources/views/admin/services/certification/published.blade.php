@extends('admin.template')

@section('title', 'Published')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Published</h1>

        @include('admin.includes.breadcrumb')
    </div>

@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card card-search">
                <div class="header">
                    <h2>Filter</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-lg-2">
                            <p>Name</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-10 col-md-6">
                            <div class="input-group">
                                <input type="text" id="title" class="form-control" name="title">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <button id="search" type="button" class="btn btn-sm btn-info btn-block btn-search">Search</button>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 1%;">
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox"><span></span></label>
                                </div>
                            </th>
                            <th>Authentication Code</th>
                            <th>Certification No.</th>
                            <th>Name</th>
                            <th>Date Released</th>
                            <th>Released By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox"><span></span></label>
                                </div>
                            </td>
                            <td><a href="{{ route('view') }}">A-001</a></td>
                            <td>C-0001</td>
                            <td>John Doe</td>
                            <td>01/01/2021</td>
                            <td>Peter Simon</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox"><span></span></label>
                                </div>
                            </td>
                            <td><a href="{{ route('view') }}">A-002</a></td>
                            <td>C-0002</td>
                            <td>John Doe</td>
                            <td>01/01/2021</td>
                            <td>Peter Simon</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <ul class="pagination mt-2" style="float: right;" >
                <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                <li class="page-item text-center" style="width: 100px;"><a class="page-link" href="javascript:void(0);">Next</a></li>
            </ul>

            <div class="row "  style="float: left; margin-top:  10px">
               <div class="col-md-12">
                  <button class="btn btn-sm btn-success">Generate Certificates</button>
               </div>
           </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/published/archives.js') }}"></script>
@endsection
