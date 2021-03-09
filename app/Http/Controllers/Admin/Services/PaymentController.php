<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Admin\Invoices;
use App\Models\Admin\InvoiceItems;
use App\Models\Admin\PaymentMethods;
use App\Models\Admin\Payments;

class PaymentController extends Controller
{
    public function index ()
    {
        $payments = Payments::getPayments();
        return view('admin.services.billing.payment-index', compact('payments'));
    }

    public function new($id)
    {
        $today = date('d/m/Y');
        $invoice = Invoices::getByID($id);
        $invoice_items = InvoiceItems::getInvoiceItems($id);
        $payment_methods = PaymentMethods::getPaymentMethods();

        return view('admin.services.billing.payment-new', compact('today', 'invoice', 'invoice_items', 'payment_methods'));
    }

    public function store(Request $request) 
    {   
        $request->request->add(['userID' => Auth::id()]);
        $data = Payments::add($request);

        echo json_encode($data);
    }

    public function view($id)
    {
        $payment = Payments::getByID($id);
        $invoice = Invoices::getByID($payment->reference_id);
        $invoice_items = InvoiceItems::getInvoiceItems($payment->reference_id);

        return view('admin.services.billing.payment-view', compact('payment', 'invoice', 'invoice_items'));
    }

    public function forms($id)
    {
        $payment = Payments::getByID($id);
        $invoice = Invoices::getByID($payment->reference_id);
        $invoice_items = InvoiceItems::getInvoiceItems($payment->reference_id);

        return view('admin.forms.or', compact('payment', 'invoice', 'invoice_items'));
    }
}
