@extends('admin.template')

@section('title', 'Services - Billing (New)')
@section('title', 'Services - Billing (Invoice No.: '.$invoice->invoice_no.')')

@section('css')
    
@endsection

@section('breadcrumb')
     <div class="col-md-6 col-sm-12">
        <h1>Invoice No.: {{ $invoice->invoice_no }}</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <a href="{{ route('classes-edit', $invoice->invoice_id) }}" class="btn btn-success" style="width: 100px;">Edit</a>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>

                <div class="dropdown-menu" x-placement="bottom-start">
                    <a href="" id="mark-as-active" class="btn btn-new btn-default dropdown-item" data-target="#compli" data-toggle="modal">Pay</a>
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
                                            <label>Invoice No.</label><br>
                                            <label class="block"><b>{{ $invoice->invoice_no }}</b></label>
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
                                            <label>Invoice Date</label>
                                            <label class="block">{{ date('d/m/Y', strtotime($invoice->invoice_date)) }}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6"></div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Due Date</label> 
                                            <label class="block">{{ date('d/m/Y', strtotime($invoice->due_date)) }}</label>
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
                                                    <label>Subtotal</label>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label id="summary-sub-total" class=" pull-right">{{ $invoice->subtotal }}</label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label>Discount</label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label id="summary-discount" class=" pull-right">{{ $invoice->total_discount }}</label>
                                                </div>

                                               

                                                <div class="col-lg-12" style="margin-top: 15px; border-bottom: 1px solid; margin-bottom: 2%;">
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label><b>Total</b></label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label id="summary-total" class=" pull-right" style="font-weight: bold;">{{ $invoice->net }}</label>
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
                                    <label class="block">{{ $invoice->order_memo }}</label>
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
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#items">Items</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#billing">Billing</a></li>
                            <li class="nav-item"><a class="nav-link tab" data-toggle="tab" href="#accounting">Accounting</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="items">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Items <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="dt" class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-right" style="width: 5%">Qty</th>
                                                    <th style="width: 30%">Item Name</th>
                                                    <th>Description</th>
                                                    <th class="text-right" style="width: 10%">Rate</th>
                                                    <th class="text-right" style="width: 10%">Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($invoice_items as $row)
                                                    <tr>
                                                        <td class="text-right">{{ $row->quantity }}</td>
                                                        <td>{{ $row->item_name }}</td>
                                                        <td>{{ $row->item_description }}</td>
                                                        <td class="text-right">{{ $row->rate }}</td>
                                                        <td class="text-right">{{ $row->amount }}</td>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="billing">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card" style="margin-top: 15px;">
                                    <div class="header">
                                        <h2>Billing <small>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used in laying out print, graphic or web designs.</small></h2>
                                    </div>

                                    <div class="body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                   <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Bill To</label>
                                                            <label class="block">{{ $invoice->billing_to }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <label class="block">{{ $invoice->billing_address }}</label>
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
                                                     <label>Sub Total</label>
                                                     <label class="block">{{ $invoice->subtotal }}</label>
                                                 </div>
                                             </div>

                                             <div class="col-lg-6"></div>

                                             <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Discount</label>
                                                     <label class="block">{{ $invoice->total_discount }}</label>
                                                 </div>
                                             </div>

                                             <div class="col-lg-6"></div>

                                             <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Total</label>
                                                     <label class="block"><b>{{ $invoice->net }}</b></label>
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
