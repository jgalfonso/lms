@extends('admin.template')

@section('title', 'New Invoice')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-6 col-sm-12">
        <h1>New Invoice</h1>

        @include('admin.includes.breadcrumb')
    </div>
@endsection

@section('content')
    <div id="alert"></div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <a href="#" class="btn btn-success" type="button" style="width: 100px;">Save</a>
            <a href="#t" class="btn btn-danger" type="button" style="width: 100px;">Cancel</a>
        </div>

        <div class="col-lg-12"  style="margin-top: 15px;">
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
                                        <select class="form-control" required>
                                            <option value="">Marshall Nichols</option>
                                            <option value="">Susie Willis</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Reference No.</label>
                                        <input type="text" class="form-control" value="" readonly style="background-color: #f9fafb;">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label>Invoice Date <span class="required">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input id="invoice-date" data-date-autoclose="true" class="form-control" data-date-format="dd-mm-yyyy" required data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-invoice-date">
                                    </div>

                                    <p id="error-invoice-date"></p>
                                </div>

                                <div class="col-lg-6"></div>

                                <div class="col-lg-6">
                                    <label>Due Date <span class="required">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input id="invoice-date" data-date-autoclose="true" class="form-control" data-date-format="dd-mm-yyyy" required data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-invoice-date">
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
                                                <label id="summary-discount-item" class=" pull-right">0.00</label>
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
                                <textarea name="name" class="form-control" rows="4" cols="80"></textarea>
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
                                    <table class="table table-hover js-basic-example dataTable table-custom spacing5 mb-0" id="myTable">
                                        <thead>
                                            <tr>

                                                <th class="text-right" style="width: 5%">Qty</th>
                                                <th style="width: 30%">Item Name</th>
                                                <th>Description</th>
                                                <th class="text-right" style="width: 10%">Rate</th>
                                                <th class="text-right" style="width: 10%">Total</th>
                                                <th style="width: 1%;" class="text-center"><i class="fa fa-level-down"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td class="text-right">1</td>
                                                <td>Enrollment Fee</td>
                                                <td>ELorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used<br>in laying out print, graphic or web designs.</td>
                                                <td class="text-right">150.00</td>
                                                <td class="text-right">150.00</td>
                                                <td class="align-center">
                                                    <button class="btn btn-sm btn-default" title="Delete"><i class="fa fa-edit"></i></button>
                                                     <button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="text-right">1</td>
                                                <td>Courier Fee</td>
                                                <td>Lorem ipsum, or lipsum as it is sometimes known, <code>is dummy text</code>  used<br>in laying out print, graphic or web designs.</td>
                                                <td class="text-right">120.00</td>
                                                <td class="text-right">120.00</td>
                                                <td class="align-center">
                                                    <button class="btn btn-sm btn-default" title="Delete"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="6">  <button type="button" class="btn btn-default float-right"  data-toggle="modal" data-target="#addClass">Add Item</button></td>
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
                                                        <input id="balance" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <textarea id="billing-address" class="form-control" rows="4"></textarea>
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
                                                 <input id="exchange-rate" type="text" class="form-control" readonly value="" style="background-color: #f9fafb;">
                                             </div>
                                         </div>

                                         <div class="col-lg-6"></div>

                                         <div class="col-lg-6">
                                             <div class="form-group">
                                                 <label>Discount</label>
                                                 <input id="exchange-rate" type="text" class="form-control" required value="">
                                             </div>
                                         </div>

                                         <div class="col-lg-6"></div>

                                         <div class="col-lg-6">
                                             <div class="form-group">
                                                 <label>Total</label>
                                                 <input id="exchange-rate" type="text" class="form-control" readonly value="" style="background-color: #f9fafb;">
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
                <div class="action-btn" style="padding-bottom: 3%;">
                    <button type="submit" class="btn btn-success" style="width: 100px">Save</button>
                    <a href="javascript:history.back()" class="btn btn-danger" style="width: 100px">Cancel</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Item*</label>
                            <select class="form-control">
                                <option selected="">Choose...</option>
                                <option>Enrollment Fee</option>
                                <option>Courier Fee</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Description:</label>
                            <input type="text" class="form-control" id="recipient-name" style="background-color: #f9fafb;">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Qty:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Rate:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Amount:</label>
                            <input type="text" class="form-control" id="message-text" style="background-color: #f9fafb;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="width: 100px;">Add</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/alert.js') }}"></script>

    <script src="{{ URL::asset('admin/js/billing/new-invoice.js') }}"></script>
@endsection
