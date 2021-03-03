@extends('admin.template')

@section('title', 'Services - Billing (OR No.: '.$payment->or_no.')')
   
@section('css')
    
@endsection

@section('breadcrumb')
     <div class="col-md-6 col-sm-12">
        <h1>OR No.: {{ $payment->or_no }}</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>

                <div class="dropdown-menu" x-placement="bottom-start">
                    <a href="" id="cancel" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Cancel</a>
                    <a href="" id="print" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Print</a>
                </div>
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
                                            <label class="block"><b>{{ $payment->or_no }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6"></div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <label class="block"><b>{{ $payment->lastname }}, {{ $payment->firstname }} {{ $payment->middlename }}</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Reference No.</label>
                                            <label class="block">{{ $payment->control_no }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Payment Date</label> <span class="required">*</span>
                                            <label class="block">{{ date('d/m/Y', strtotime($payment->payment_date)) }}</label>
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
                                                    <label>Amount Due</label>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label id="summary-sub-total" class=" pull-right">{{ number_format($payment->amount_due, 2) }}</label>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label>Amount Paid</label>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label id="summary-sub-total" class=" pull-right">{{ number_format($payment->amount_paid, 2) }}</label>
                                                </div>

                                                <div class="col-lg-12" style="margin-top: 15px; border-bottom: 1px solid; margin-bottom: 2%;">
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label><b>Balance</b></label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label id="summary-total" class=" pull-right" style="font-weight: bold;">{{ number_format($payment->balance, 2) }}</label>
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
                                    <label class="block">{{ $payment->order_memo }}</label>
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
                                                    <label class="block">{{ $payment->payment_method }}</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6"></div>

                                            <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Reference No.</label>
                                                     <label class="block">{{ $payment->reference_no }}</label>
                                                 </div>
                                             </div>


                                            <div class="col-lg-6"></div>

                                            <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Amount Due</label>
                                                     <label class="block">{{ number_format($payment->amount_due, 2) }}</label>
                                                 </div>
                                             </div>

                                             <div class="col-lg-6"></div>

                                             <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Amount Paid</label>
                                                     <label class="block"><b>{{ number_format($payment->amount_paid, 2) }}</b></label>
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
        </form>
    </div>
@endsection

@section('script')
   
@endsection
