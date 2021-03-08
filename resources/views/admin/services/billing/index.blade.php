@extends('admin.template')

@section('title', 'Services - Billing (Invoices)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Invoices</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right hidden-xs">
        <a href="{{ url('admin/services/billing/invoices/new/') }}" class="btn btn-sm btn-primary" title="" style="width: 120px">New Invoice</a>
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div class="col-md-12">
            <div class="card" style="margin-bottom: 10px;">
                <div class="body">
                    <ul class="accordion2" style="border: 0;">
                        <li class="accordion-item" style="border: 0;">
                            <h3 class="accordion-thumb"><span>Filter</span></h3>
                            <div class="accordion-panel" style="display: none;">
                                <div class="row" style="margin-top: 15px; ">
                                    <div class="col-lg-6 col-md-4 col-sm-6">
                                        <label>Filter by Name / Invoice No:</label>
                                        <div class="input-group">
                                            <input id="key" type="text" class="form-control" placeholder="Search...">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-4 col-sm-6 text-right">
                                        <label>&nbsp;</label>
                                        <button id="search" type="button" class="btn btn-sm btn-info btn-block" style="width: 100px">Search</button>
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
                <table id="dt" class="table dataTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width: 15%;">Invoice No.</th>
                            <th>Customer</th>
                            <th style="width: 10%;">Invoice Date</th>
                            <th style="width: 10%;">Paid On</th>
                            <th style="width: 10%;">Amount</th>
                            <th style="width: 10%;">Unpaid</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 1%;"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($invoices as $row)
                            <tr>
                                <td>{{ $row->invoice_id }}</td>
                                <td><a href="{{ route('invoices-view', $row->invoice_id) }}">{{ $row->invoice_no }}</a></td>
                                <td><b>{{ $row->control_no }}</b><br/><a href="{{ route('students-view', $row->customer_id) }}">{{ $row->lastname }} , {{ $row->firstname }} {{ $row->middlename }}</a></td>
                                <td>{{ date('d/m/Y', strtotime($row->invoice_date)) }}</td>
                                <td>@if($row->due_date) {{ date('d/m/Y', strtotime($row->due_date)) }} @endif</td>
                                <td>{{ number_format($row->net, 2) }}</td>
                                <td>@if($row->status == 'Partial') {{ number_format($row->unpaid, 2) }} @endif</td>
                                <td>{{ $row->status }}</td>
                                <td class="align-center">
                                    @if($row->status == 'Paid') 
                                        <a class="btn btn-sm btn-default" style="color: #cbcdd0; cursor: not-allowed;"><i class="fa fa-credit-card"></i></a>
                                    @else
                                        <a href="{{ route('payments-new', $row->invoice_id) }}" class="btn btn-sm btn-default" title="Make Payment"><i class="fa fa-credit-card"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/billing/index.js') }}"></script>
@endsection
