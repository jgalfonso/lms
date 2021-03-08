@extends('admin.template')

@section('title', 'Services - Billing (New Payment)')
   
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.css') }}">
    
    <style type="text/css">
        .parsley-errors-list {
            width: 100%;
        }
    </style>
@endsection

@section('breadcrumb')
     <div class="col-md-6 col-sm-12">
        <h1>New Payment</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
            </div> 

            <div class="col-lg-12" style="margin-top: 15px;">
                <div class="card">
                    <div class="header">
                        <h2>Invoice Information <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>OR No.</label><br>
                                            <label class="block"><b>To Be Generated</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6"></div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <label class="block"><b>{{ $invoice->lastname }}, {{ $invoice->firstname }} {{ $invoice->middlename }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Reference No.</label>
                                            <label class="block">{{ $invoice->control_no }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Payment Date</label> <span class="required">*</span>
                                            <div class="input-group mb-3"   >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input id="paymentDate" name="paymentDate" type="text" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" value="{{ $today }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6"></div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-footer text-center">
                                            <div class="row clearfix" style="margin-left: 0%; color: rgb(23, 25, 28);">
                                                <h6 class="mt-3">Summary</h6>
                                            </div>
                                        </div>

                                        <div class="body">
                                            <div class="row">
                                               <div class="col-lg-6">
                                                    <label>Net</label>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label id="summary-sub-total" class=" pull-right">{{ number_format($invoice->net, 2) }}</label>
                                                </div>

                                                <div class="col-lg-12" style="margin-top: 15px; border-bottom: 1px solid; margin-bottom: 2%;">
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label><b>Unpaid</b></label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label id="summary-total" class=" pull-right" style="font-weight: bold;">{{ number_format($invoice->unpaid, 2) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>  

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Memo <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Order Memo</label>
                                    <textarea name="orderMemo" class="form-control" rows="4" cols="80"></textarea>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#invoice">Invoice</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#accounting">Accounting</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="invoice">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Invoice <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">Invoice No.</th>
                                                    <th style="width: 10%">Date Issued</th>
                                                    <th>Memo</th>
                                                    <th class="text-right" style="width: 10%">Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td><a href="{{ route('invoices-view', $invoice->invoice_id) }}"><b>{{ $invoice->invoice_no }}</b></a></td>
                                                    <td>{{ date('d/m/Y', strtotime($invoice->invoice_date)) }}</td>
                                                    <td class="word-wrap">{{ $invoice->order_memo }}</td>
                                                    <td class="text-right">{{ number_format($invoice->net, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-right" style="width: 5%">Qty</th>
                                                    <th style="width: 20%">Item Name</th>
                                                    <th>Description</th>
                                                    <th class="text-right" style="width: 10%">Rate</th>
                                                    <th class="text-right" style="width: 10%">Total</th>
                                                    <th class="text-right" style="width: 10%">Discount</th>
                                                    <th class="text-right" style="width: 10%">Net</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($invoice_items as $row)
                                                    <tr>
                                                        <td class="text-right">{{ $row->quantity }}</td>
                                                        <td>{{ $row->item_name }}</td>
                                                        <td>{{ $row->item_description }}</td>
                                                        <td class="text-right">{{ number_format($row->rate / $row->quantity, 2) }}</td>
                                                        <td class="text-right">{{ number_format($row->rate, 2) }}</td>
                                                        <td class="text-right">{{ number_format($invoice->total_discount, 2) }}</td>
                                                        <td class="text-right">{{ number_format($row->amount, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="accounting">
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Accounting <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                                    </div>

                                    <div class="body">
                                         <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Payment Method</label>
                                                    <select name="paymentMethod" class="form-control" required>
                                                        <option value="" selected>Choose...</option>
                                                        
                                                        @foreach ($payment_methods as $row)
                                                            <option value="{{ $row->payment_method_id }}">{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6"></div>

                                            <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Reference No.</label>
                                                     <input name="referenceNO" type="text" class="form-control">
                                                 </div>
                                             </div>


                                            <div class="col-lg-6"></div>

                                            <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Amount Due</label>
                                                     <label id="amountDue" name="amountDue" class="block"><b>{{ number_format($invoice->unpaid, 2) }}</b></label>
                                                 </div>
                                             </div>

                                             <div class="col-lg-6"></div>

                                             <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Amount Paid</label>
                                                     <input name="amountPaid" type="number" class="form-control" required>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">    
                <div style="padding-bottom: 3%;">
                    <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                    <button type="button" onclick="history.back();" class="btn btn-danger" style="width: 100px;">Cancel</button>
                </div>
            </div>

            <input id="invoiceID" name="invoiceID"  type="hidden" value="{{ $invoice->invoice_id }}">  
            <input name="admissionID" type="hidden" value="{{ $invoice->reference_id }}">  
            <input name="customerID" type="hidden" value="{{ $invoice->customer_id }}">  
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/billing/payment-new.js') }}"></script>
@endsection
