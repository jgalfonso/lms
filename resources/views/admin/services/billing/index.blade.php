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
        <a href="{{ url('admin/services/billing/new-invoice') }}" class="btn btn-sm btn-primary" title="" style="width: 120px">New Invoice</a>
    </div>
@endsection

@section('content')
	<div class="row clearfix">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dt" class="table dataTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width: 1%;">
                                <label class="fancy-checkbox">
                                    <input type="checkbox" class="select-all"><span style="width: 1%;"></span>
                                </label>
                            </th>
                            <th style="width: 15%;">Invoice No.</th>
                            <th>Customer</th>
                            <th style="width: 10%;">Invoice Date</th>
                            <th style="width: 10%;">Paid On</th>
                            <th style="width: 10%;">Amount</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 1%;"><i class="fa fa-level-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($invoices as $row)
                            <tr>
                                <td>{{ $row->invoice_id }}</td>
                                <td>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" class="checkbox"><span style="width: 1%;"></span>
                                    </label>
                                </td>
                                <td><a href="{{ route('billing-view_invoice', $row->invoice_id) }}">{{ $row->invoice_no }}</a></td>
                                <td><b>{{ $row->control_no }}</b><br/><a href="{{ route('students-view', $row->customer_id) }}">{{ $row->lastname }} , {{ $row->firstname }} {{ $row->middlename }}</a></td>
                                <td>{{ $row->invoice_date }}</td>
                                <td>{{ $row->due_date }}</td>
                                <td>{{ $row->net }}</td>
                                <td>{{ $row->status }}</td>
                                <td class="align-center"><a href="{{ route('classes-edit', $row->invoice_id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row action-mark">
                <div class="col-md-12">
                    <button id="pay" class="btn btn-success" type="button">Pay</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/billing/index.js') }}"></script>
@endsection
