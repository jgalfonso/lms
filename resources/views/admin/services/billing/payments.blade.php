@extends('admin.template')

@section('title', 'Payments')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Payments</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right">
        <a href="{{ route('new-payment') }}" class="btn btn-sm btn-primary btn-new" title="">New Payment</a>
    </div>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card" style="margin-bottom: 10px;">
                <div class="body">
                    <ul class="accordion2" style="border: 0;">
                        <li class="accordion-item" style="border: 0;">
                            <h3 class="accordion-thumb"><span>Filter</span></h3>
                            <div class="accordion-panel" style="display: none;">
                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6">
                                        <label>OR No.</label>
                                        <input type="text" id="title" class="form-control" name="title">
                                    </div>

                                    <div class="col-lg-3">
                                        <label>Payment Date</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="date_closed" >
                                        </div>
                                         <span class="help-block">Start Date</span>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>&nbsp;</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="date_closed" >
                                        </div>
                                         <span class="help-block">End Date</span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6">
                                        <label>Customer</label>
                                        <input type="text" id="from" data-date-autoclose="true" class="form-control date" name="date_closed" >

                                    </div>
                                    <div class="col-lg-3">
                                        <label>Status</label>
                                        <select class="form-control">
                                            <option value="" selected>Select...</option>
                                            <option value="">New</option>
                                            <option value="">Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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
                                    <label><input type="checkbox"><span style="width: 1%;"></span></label>
                                </div>
                            </th>
                            <th style="width: 15%;">OR No.</th>
                            <th>Customer</th>
                            <th style="width: 10%;">Payment Date</th>
                            <th style="width: 10%;">Payment Method</th>
                            <th class="text-right" style="width: 10%;">Amount</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox"><span style="width: 1%;"></span></label>
                                </div>
                            </td>
                            <td><a href="">OR-0000000011</a></td>
                            <td><b>XOPSDDEEE</b><br/><a href="">Carla Smith</a></td>
                            <td>01 Feb 2021</td>
                            <td>Cash</td>
                            <td class="text-right">150.00</td>
                            <td>Active</td>
                            <td class="align-center"><button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox"><span style="width: 1%;"></span></label>
                                </div>
                            </td>
                            <td><a href="">OR-0000000012</a></td>
                            <td><b>B2O6W788D8</b><br/><a href="">John Smith</a></td>
                            <td>27 Jan 2021</td>
                            <td>Cash</td>
                            <td class="text-right">120.00</td>
                            <td>Active</td>
                            <td class="align-center"><button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button></td>
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

           </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/billing/invoices.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".accordion-thumb").click(function() {
                $(this).closest( "li" ).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
            });
        })
    </script>
@endsection
