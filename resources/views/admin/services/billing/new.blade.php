@extends('admin.template')

@section('title', 'Services - Billing (New Invoice)')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.css') }}">
    
    <style type="text/css">
        .modal-body table th, .modal-body table td {
            background: #f6f7f9 !important;
        }

        .parsley-errors-list {
            width: 100%;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>New Invoice</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div class="row clearfix">
        <div id="alert" class="col-lg-12"></div>

        <form id="form" method="post" novalidate style="width: 100%;">
            <div class="col-lg-12">
                <button type="button" class="btn btn-success save" style="width: 100px;">Save</button>
                <a href="/admin/services/enrollment/enroll-student" class="btn btn-danger" style="width: 100px;">Cancel</a>
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
                                            <label class="block"><b>To Be Generated</b></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6"></div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Customer Name <span class="required">*</span></label>
                                            <select id="customer" name="customer" class="form-control" required>
                                                <option value="" selected="">Choose...</option>

                                                @foreach ($customers as $row)
                                                    <option value="{{ $row->profile_id }}~{{ $row->control_no }}">{{ $row->lastname }}, {{ $row->firstname }} {{ $row->middlename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Reference No.</label>
                                            <input id="referenceNO" type="text" class="form-control" readonly style="background-color: #f9fafb;">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Invoice Date</label> <span class="required">*</span>
                                            <div class="input-group mb-3"   >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input id="invoiceDate" name="invoiceDate" type="text" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" value="{{ $today }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6"></div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Due Date</label> 
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input id="dueDate" name="dueDate" type="text" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy">
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
                                                    <label>Subtotal</label>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label id="summary-sub-total" class=" pull-right">0.00</label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label>Discount</label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label id="summary-discount" class=" pull-right">0.00</label>
                                                </div>

                                               

                                                <div class="col-lg-12" style="margin-top: 15px; border-bottom: 1px solid; margin-bottom: 2%;">
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label><b>Total</b></label>
                                                </div>

                                                <div class="col-lg-6" style="margin-top: 15px;">
                                                    <label id="summary-total" class=" pull-right" style="font-weight: bold;">0.00</label>
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
                                                    <th class="hidden"></th>
                                                    <th class="text-right" style="width: 5%">Qty</th>
                                                    <th style="width: 30%">Item Name</th>
                                                    <th>Description</th>
                                                    <th class="text-right" style="width: 10%">Rate</th>
                                                    <th class="text-right" style="width: 10%">Total</th>
                                                    <th class="text-center" style="width: 1%;"><i class="fa fa-level-down"></i></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td colspan="7">  
                                                        <button type="button" class="btn btn-default float-right"  data-toggle="modal" data-target="#modal">Add Item</button>
                                                    </td>
                                                </tr>
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
                                                            <input id="billTo" name="billTo" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea id="billingAddress" name="billingAddress" class="form-control" rows="4"></textarea>
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
                                                     <input id="subTotal" name="subTotal" type="text" class="form-control" readonly style="background-color: #f9fafb;">
                                                 </div>
                                             </div>

                                             <div class="col-lg-6"></div>

                                             <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Discount</label>
                                                     <input id="discount" name="discount" type="number" class="form-control">
                                                 </div>
                                             </div>

                                             <div class="col-lg-6"></div>

                                             <div class="col-lg-6">
                                                 <div class="form-group">
                                                     <label>Total</label>
                                                     <input id="total" name="total" type="text" class="form-control" readonly style="background-color: #f9fafb;">
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
        </form>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding: 10px 0 10px 0">
                        <div id="modal-alert" class="col-lg-12" style="margin-top: 10px;"></div>

                        <div class="col-lg-12">
                            <form id="modal-form">
                                <div class="form-group">
                                    <label>Item*</label>
                                    <select id="item" class="form-control" required>
                                        <option value="" selected="">Choose...</option>

                                        @foreach ($items as $row)
                                            <option value="{{ $row->item_id }}~{{ $row->item_description }}~1~{{ $row->amount }}">{{ $row->item_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Description:</label>
                                    <input id="description" type="text" class="form-control" style="background-color: #f9fafb;" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Qty:</label>
                                    <input id="qty" type="number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Rate:</label>
                                    <input id="rate" type="number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Amount:</label>
                                    <input id="amount" type="text" class="form-control" style="background-color: #f9fafb;" readonly>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary add" style="width: 100px;">Add</button>
                        <button type="button" data-dismiss="modal" class="btn btn-default" style="width: 100px;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>
    <script src="{{ URL::asset('admin/js/services/billing/new.js') }}"></script>
@endsection
