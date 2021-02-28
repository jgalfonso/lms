<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Invoices;
use App\Models\Admin\InvoiceItems;
use App\Models\Admin\Items;
use App\Models\Admin\Profiles;

class PaymentController extends Controller
{
    public function index ()
    {
        $invoices = Invoices::getInvoices();
        return view('admin.services.billing.index', compact('invoices'));
    }

    public function new($id)
    {
        $today = date('d-m-Y');
        $invoice = Invoices::getByID($id);
        $invoice_items = InvoiceItems::getInvoiceItems($id);

        return view('admin.services.billing.payment-new', compact('today', 'invoice', 'invoice_items'));
    }

    public function store(Request $request) 
    {   
        $request->request->add(['userID' => Auth::id()]);
        $data = Invoices::add($request);

        echo json_encode($data);
    }

    public function view($id)
    {
        $invoice = Invoices::getByID($id);
        $invoice_items = InvoiceItems::getInvoiceItems($id);

        return view('admin.services.billing.view', compact('invoice', 'invoice_items'));
    }
}
