@extends('admin.template')

@section('title', 'Services - Billing (Payments)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>Payments</h1>

        @include('admin.includes.breadcrumb')
    </div>

    <div class="col-md-6 col-sm-12 text-right hidden-xs">
        
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
                                        <label>Filter by Name / OR No:</label>
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
                            <th style="width: 10%;">OR No.</th>
                            <th>Customer</th>
                            <th style="width: 10%;">Payment Date</th>
                            <th style="width: 10%;">Amount Due</th>
                            <th style="width: 10%;">Amount Paid</th>
                            <th style="width: 10%;">Balance</th>
                            <th style="width: 10%;">Invoice No.</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($payments as $row)
                            <tr>
                                <td>{{ $row->payment_id }}</td>
                                <td><a href="{{ route('payments-view', $row->payment_id) }}">{{ $row->or_no }}</a></td>
                                <td><b>{{ $row->control_no }}</b><br/><a href="{{ route('students-view', $row->customer_id) }}">{{ $row->lastname }} , {{ $row->firstname }} {{ $row->middlename }}</a></td>
                                <td>{{ date('d/m/Y', strtotime($row->payment_date)) }}</td>
                                <td>{{ number_format($row->amount_due, 2) }}</td>
                                <td>{{ number_format($row->amount_paid, 2) }}</td>
                                <td>{{ number_format($row->balance, 2) }}</td>
                                <td><a href="{{ route('invoices-view', $row->reference_id) }}">{{ $row->invoice_no }}</a></td>
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
    <script src="{{ URL::asset('admin/js/services/billing/payment-index.js') }}"></script>
@endsection
